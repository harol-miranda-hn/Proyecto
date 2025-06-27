<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Asistencia;
use App\Models\AsistenciaAlumno;
use App\Models\Grado;
use Illuminate\Http\Request;

class AsistenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Asistencia::with('grado');

        if ($request->filled('search')) {
            $search = strtolower($request->search);

            $query->whereHas('grado', function ($q) use ($search) {
                $q->whereRaw('LOWER(curso) LIKE ?', ["%$search%"])
                    ->orWhereRaw('LOWER(modalidad) LIKE ?', ["%$search%"])
                    ->orWhereRaw('LOWER(seccion) LIKE ?', ["%$search%"])
                    ->orWhereRaw('LOWER(jornada) LIKE ?', ["%$search%"]);
            });
        }

        if ($request->filled('fecha')) {
            $query->whereDate('fecha', $request->fecha);
        }

        $asistencias = $query->orderBy('fecha', 'desc')->paginate(5)->appends($request->only('search', 'fecha'));

        return view('asistencias.index', compact('asistencias'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $hoy = now()->toDateString();

        $grados = Grado::whereHas('matriculas') // Grados con alumnos
        ->whereDoesntHave('asistencias', function ($query) use ($hoy) {
            $query->where('fecha', $hoy); // Que no tengan asistencia hoy
        })
            ->orderBy('curso')
            ->get();

        return view('asistencias.create', compact('grados'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'grado_id' => 'required|exists:grados,id',
            'fecha' => 'required|date',
            'estados' => 'required|array',
            'estados.*' => 'in:asistio,falto,excusado'
        ], [
            'grado_id.required' => 'Debe seleccionar un grado.',
            'grado_id.exists' => 'El grado seleccionado no es válido.',

            'fecha.required' => 'La fecha es obligatoria.',
            'fecha.date' => 'La fecha no tiene un formato válido.',

            'estados.required' => 'Debe registrar el estado de asistencia de cada alumno.',
            'estados.*.in' => 'El estado de asistencia debe ser: asistió, faltó o excusado.',
        ]);

        $asistencia = Asistencia::create([
            'grado_id' => $validated['grado_id'],
            'fecha' => $validated['fecha'],
        ]);

        foreach ($validated['estados'] as $alumnoId => $estado) {
            AsistenciaAlumno::create([
                'asistencia_id' => $asistencia->id,
                'alumno_id' => $alumnoId,
                'estado' => $estado,
            ]);
        }

        return redirect()->route('asistencias.index')->with('status', 'Asistencia registrada correctamente.');
    }

    public function show(Asistencia $asistencia)
    {
        $asistencia->load('grado', 'asistenciaAlumnos.alumno');
        return view('asistencias.show', compact('asistencia'));
    }

    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Asistencia $asistencia)
    {
        $asistencia->load('grado', 'asistenciaAlumnos');

        $alumnos = \App\Models\Alumno::whereHas('matriculas', function ($q) use ($asistencia) {
            $q->where('grado_id', $asistencia->grado_id);
        })->orderBy('nombre_completo')->get();

        // Mapeo de estados por alumno_id para acceder directamente
        $estados = $asistencia->asistenciaAlumnos->pluck('estado', 'alumno_id');

        return view('asistencias.edit', compact('asistencia', 'alumnos', 'estados'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Asistencia $asistencia)
    {
        $validated = $request->validate([
            'estados' => 'required|array',
            'estados.*' => 'in:asistio,falto,excusado'
        ]);

        foreach ($validated['estados'] as $alumnoId => $estado) {
            AsistenciaAlumno::updateOrCreate(
                ['asistencia_id' => $asistencia->id, 'alumno_id' => $alumnoId],
                ['estado' => $estado]
            );
        }

        return redirect()->route('asistencias.index')->with('status', 'Asistencia actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Asistencia $asistencia)
    {
        $asistencia->delete();
        return redirect()->route('asistencias.index')->with('status', 'Asistencia eliminada correctamente.');
    }
}
