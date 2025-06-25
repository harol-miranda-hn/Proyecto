<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Asignatura;
use App\Models\Calificacion;
use App\Models\Grado;
use App\Models\Matricula;
use Illuminate\Http\Request;

class CalificacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Obtener IDs de matrículas y sus promedios
        $promediosQuery = Calificacion::selectRaw('matricula_id, AVG((COALESCE(parcial_1,0) + COALESCE(parcial_2,0) + COALESCE(parcial_3,0) + COALESCE(parcial_4,0)) / 4) as promedio_general')
            ->groupBy('matricula_id');

        if ($request->filled('search')) {
            $search = $request->search;

            // Subconsulta para buscar alumnos por nombre
            $promediosQuery->whereIn('matricula_id', function ($q) use ($search) {
                $q->select('id')
                    ->from('matriculas')
                    ->whereIn('alumno_id', function ($sq) use ($search) {
                        $sq->select('id')
                            ->from('alumnos')
                            ->where('nombre_completo', 'like', "%{$search}%");
                    });
            });
        }

        // Obtener datos paginados
        $paginados = $promediosQuery->paginate(10)->appends(['search' => $request->search]);

        // Obtener IDs de matrícula
        $matriculaIds = $paginados->pluck('matricula_id')->toArray();

        // Traer las matrículas con relaciones
        $matriculas = \App\Models\Matricula::with(['alumno', 'grado'])
            ->whereIn('id', $matriculaIds)
            ->get()
            ->keyBy('id');

        // Combinar datos
        foreach ($paginados as $item) {
            $item->matricula = $matriculas[$item->matricula_id] ?? null;
        }

        return view('calificaciones.index', ['promedios' => $paginados]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Filtrar alumnos que no tengan calificaciones asignadas
        $alumnos = Alumno::whereHas('matriculas.grado.asignaturas')
            ->whereHas('matriculas', function ($q) {
                $q->whereDoesntHave('calificaciones');
            })
            ->with('matriculas.grado.asignaturas')
            ->orderBy('nombre_completo')
            ->get();

        return view('calificaciones.create', compact('alumnos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'matricula_id' => ['required', 'exists:matriculas,id'],
            'calificaciones' => ['required', 'array'],
            'calificaciones.*.asignatura_id' => ['required', 'exists:asignaturas,id'],
            'calificaciones.*.parcial_1' => ['nullable'],
            'calificaciones.*.parcial_2' => ['nullable'],
            'calificaciones.*.parcial_3' => ['nullable'],
            'calificaciones.*.parcial_4' => ['nullable'],
        ]);

        foreach ($request->calificaciones as $index => $item) {
            $valores = collect([
                $item['parcial_1'] ?? null,
                $item['parcial_2'] ?? null,
                $item['parcial_3'] ?? null,
                $item['parcial_4'] ?? null,
            ]);

            $notasConvertidas = $valores->map(function ($val) {
                if (is_string($val) && strtoupper($val) === 'NSP') return 0;
                if (is_numeric($val)) return (float) $val;
                return null;
            });

            if ($notasConvertidas->filter(fn($n) => $n !== null)->isEmpty()) {
                return back()->withErrors([
                    "calificaciones.{$index}" => "Debe ingresar al menos una nota válida (0-100 o 'NSP') por asignatura.",
                ])->withInput();
            }

            foreach ($notasConvertidas as $n) {
                if ($n !== null && ($n < 0 || $n > 100)) {
                    return back()->withErrors([
                        "calificaciones.{$index}" => "Las notas deben estar entre 0 y 100, o ser 'NSP'.",
                    ])->withInput();
                }
            }

            Calificacion::updateOrCreate(
                [
                    'matricula_id' => $request->matricula_id,
                    'asignatura_id' => $item['asignatura_id'],
                ],
                [
                    'parcial_1' => $notasConvertidas[0],
                    'parcial_2' => $notasConvertidas[1],
                    'parcial_3' => $notasConvertidas[2],
                    'parcial_4' => $notasConvertidas[3],
                ]
            );
        }

        return redirect()->route('calificaciones.index')
            ->with('status', 'Calificaciones registradas correctamente.');
    }


    /**
     * Display the specified resource.
     */
    public function show($matricula_id)
    {
        $matricula = Matricula::with(['alumno', 'grado'])->findOrFail($matricula_id);

        // Obtener asignaturas asignadas al grado
        $asignaturas = $matricula->grado->asignaturas()->orderBy('nombre')->get();

        // Obtener calificaciones asociadas a la matrícula
        $calificaciones = Calificacion::where('matricula_id', $matricula_id)
            ->get()
            ->keyBy('asignatura_id');

        // Calcular promedios y estado por asignatura
        $promedios = [];

        foreach ($asignaturas as $asignatura) {
            $cal = $calificaciones->get($asignatura->id);

            if ($cal) {
                $notas = array_filter([
                    $cal->parcial_1,
                    $cal->parcial_2,
                    $cal->parcial_3,
                    $cal->parcial_4,
                ], fn ($nota) => $nota !== null);

                $cantidadNotas = count($notas);
                $promedio = $cantidadNotas ? round(array_sum($notas) / $cantidadNotas, 2) : 0.00;

                if ($cantidadNotas < 3) {
                    $estado = 'Abandonó';
                } elseif ($promedio >= 70) {
                    $estado = 'Aprobó';
                } else {
                    $estado = 'Reprobó';
                }

                $promedios[$asignatura->id] = [
                    'promedio' => $promedio,
                    'estado' => $estado,
                ];
            } else {
                $promedios[$asignatura->id] = [
                    'promedio' => 0.00,
                    'estado' => 'N/A',
                ];
            }
        }

        return view('calificaciones.show', compact(
            'matricula',
            'asignaturas',
            'calificaciones',
            'promedios'
        ));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $matricula = Matricula::with('alumno', 'grado')->findOrFail($id);
        $calificaciones = Calificacion::where('matricula_id', $matricula->id)->with('asignatura')->get();

        return view('calificaciones.edit', compact('matricula', 'calificaciones'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $matriculaId)
    {
        $request->validate([
            'calificaciones' => ['required', 'array'],
            'calificaciones.*.asignatura_id' => ['required', 'exists:asignaturas,id'],
            'calificaciones.*.parcial_1' => ['nullable'],
            'calificaciones.*.parcial_2' => ['nullable'],
            'calificaciones.*.parcial_3' => ['nullable'],
            'calificaciones.*.parcial_4' => ['nullable'],
        ]);

        foreach ($request->calificaciones as $index => $item) {
            $valores = collect([
                $item['parcial_1'] ?? null,
                $item['parcial_2'] ?? null,
                $item['parcial_3'] ?? null,
                $item['parcial_4'] ?? null,
            ]);

            $notasConvertidas = $valores->map(function ($val) {
                if (is_string($val) && strtoupper($val) === 'NSP') return 0;
                if (is_numeric($val)) return (float) $val;
                return null;
            });

            if ($notasConvertidas->filter(fn($n) => $n !== null)->isEmpty()) {
                return back()->withErrors([
                    "calificaciones.{$index}" => "⚠️ Debe ingresar al menos una nota válida (0-100 o 'NSP') por asignatura.",
                ])->withInput();
            }

            foreach ($notasConvertidas as $n) {
                if ($n !== null && ($n < 0 || $n > 100)) {
                    return back()->withErrors([
                        "calificaciones.{$index}" => "Las notas deben estar entre 0 y 100, o ser 'NSP'.",
                    ])->withInput();
                }
            }

            $calificacion = Calificacion::where('matricula_id', $matriculaId)
                ->where('asignatura_id', $item['asignatura_id'])
                ->first();

            if ($calificacion) {
                $calificacion->update([
                    'parcial_1' => $notasConvertidas[0],
                    'parcial_2' => $notasConvertidas[1],
                    'parcial_3' => $notasConvertidas[2],
                    'parcial_4' => $notasConvertidas[3],
                ]);
            } else {
                // Si quieres permitir creación si no existe:
                Calificacion::create([
                    'matricula_id' => $matriculaId,
                    'asignatura_id' => $item['asignatura_id'],
                    'parcial_1' => $notasConvertidas[0],
                    'parcial_2' => $notasConvertidas[1],
                    'parcial_3' => $notasConvertidas[2],
                    'parcial_4' => $notasConvertidas[3],
                ]);
            }
        }

        return redirect()->route('calificaciones.index')
            ->with('status', 'Calificaciones actualizadas correctamente.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
