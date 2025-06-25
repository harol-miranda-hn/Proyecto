<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Grado;
use App\Models\Matricula;
use Illuminate\Http\Request;

class MatriculaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Matricula::with('alumno', 'grado');

        if ($request->has('search')) {
            $query->whereHas('alumno', function ($q) use ($request) {
                $q->where('nombre_completo', 'like', '%' . $request->search . '%');
            });
        }

        $matriculas = $query->paginate(5);
        return view('matriculas.index', compact('matriculas'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Obtener los IDs de alumnos ya matriculados
        $alumnosMatriculados = Matricula::pluck('alumno_id')->toArray();

        // Filtrar alumnos que aún no han sido matriculados
        $alumnos = Alumno::whereNotIn('id', $alumnosMatriculados)->get();

        $grados = Grado::all();

        return view('matriculas.create', compact('alumnos', 'grados'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'alumno_id' => 'required|exists:alumnos,id',
            'grado_id' => 'required|exists:grados,id',
            'fecha_matricula' => 'required|date',
        ]);

        // Crear matrícula
        $matricula = Matricula::create($request->only('alumno_id', 'grado_id', 'fecha_matricula'));

        // Aumentar matrícula del grado
        $grado = Grado::find($request->grado_id);
        $grado->increment('matricula');

        return redirect()->route('matriculas.index')->with('status', 'Alumno matriculado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Matricula $matricula)
    {
        return view('matriculas.show', compact('matricula'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Matricula $matricula)
    {
        $alumnos = Alumno::all();
        $grados = Grado::all();

        return view('matriculas.edit', compact('matricula', 'alumnos', 'grados'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $matricula = Matricula::findOrFail($id);

        $request->validate([
            'grado_id' => 'required|exists:grados,id',
        ]);

        if ($request->grado_id != $matricula->grado_id) {
            // Decrementar en el grado anterior
            $matricula->grado->decrement('matricula');

            // Incrementar en el nuevo grado
            $nuevoGrado = Grado::find($request->grado_id);
            $nuevoGrado->increment('matricula');
        }

        $matricula->update($request->only('grado_id', 'fecha_matricula'));

        return redirect()->route('matriculas.index')->with('status', 'Matrícula actualizada.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $grado = Grado::findOrFail($id);

        // Verificar si hay relaciones que impidan eliminar
        $tieneMatriculas = $grado->matriculas()->exists();
        $tieneCalificaciones = $grado->calificaciones()->exists();
        $tieneAsignaturas = $grado->asignaturas()->exists();

        if ($tieneMatriculas || $tieneCalificaciones || $tieneAsignaturas) {
            return redirect()->route('grados.index')
                ->with('error', 'No se puede eliminar el grado porque hay alumnos matriculados.');
        }

        $grado->delete();

        return redirect()->route('grados.index')->with('status', 'Grado eliminado correctamente.');
    }

}
