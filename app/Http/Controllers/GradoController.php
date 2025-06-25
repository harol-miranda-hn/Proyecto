<?php

namespace App\Http\Controllers;

use App\Models\Calificacion;
use App\Models\Grado;
use Illuminate\Http\Request;

class GradoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Grado::query(); // ya no usamos withCount('alumnos')

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('curso', 'like', "%{$search}%")
                ->orWhere('modalidad', 'like', "%{$search}%")
                ->orWhere('seccion', 'like', "%{$search}%")
                ->orWhere('jornada', 'like', "%{$search}%");
        }

        $grados = $query->orderBy('modalidad')
            ->orderBy('modalidad') // posiblemente un error repetido
            ->paginate(5)
            ->appends(['search' => $request->search]);

        return view('grados.index', compact('grados'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('grados.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'curso'     => ['required', 'string', 'max:255'],
            'modalidad' => ['required', 'string', 'max:255'],
            'jornada'   => ['required', 'in:Matutina,Vespertina,Nocturna,ISEMED'],
            'seccion'   => ['required', 'in:A,B,C,D,E,F,G'],
            'matricula' => ['nullable', 'integer', 'min:0'],
        ], [
            'curso.required'     => 'El campo curso es obligatorio.',
            'modalidad.required' => 'El campo modalidad es obligatorio.',
            'jornada.required'   => 'Debe seleccionar una jornada.',
            'jornada.in'         => 'Seleccione una jornada válida.',
            'seccion.required'   => 'Debe seleccionar una sección.',
            'seccion.in'         => 'Seleccione una sección válida.',
            'matricula.integer'  => 'La matrícula debe ser un número.',
            'matricula.min'      => 'La matrícula no puede ser negativa.',
        ]);

        Grado::create($validated);

        return redirect()->route('grados.index')->with('status', 'Grado registrado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Grado $grado)
    {
        return view('grados.show', compact('grado'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Grado $grado)
    {
        return view('grados.edit', compact('grado'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Grado $grado)
    {
        $validated = $request->validate([
            'curso'     => ['required', 'string', 'max:255'],
            'modalidad' => ['required', 'string', 'max:255'],
            'jornada'   => ['required', 'in:Matutina,Vespertina,Nocturna,ISEMED'],
            'seccion'   => ['required', 'in:A,B,C,D,E,F,G'],
            'matricula' => ['nullable', 'integer', 'min:0'],
        ], [
            'curso.required'     => 'El campo curso es obligatorio.',
            'modalidad.required' => 'El campo modalidad es obligatorio.',
            'jornada.required'   => 'Debe seleccionar una jornada.',
            'jornada.in'         => 'Seleccione una jornada válida.',
            'seccion.required'   => 'Debe seleccionar una sección.',
            'seccion.in'         => 'Seleccione una sección válida.',
            'matricula.integer'  => 'La matrícula debe ser un número.',
            'matricula.min'      => 'La matrícula no puede ser negativa.',
        ]);

        $grado->update($validated);

        return redirect()->route('grados.index')->with('status', 'Grado actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $grado = Grado::findOrFail($id);

        $tieneMatriculas = $grado->matriculas()->exists();
        $tieneAsignaturas = $grado->asignaturas()->exists();

        // Verificar si existen calificaciones a través de las matrículas asociadas al grado
        $tieneCalificaciones = Calificacion::whereHas('matricula', function ($query) use ($grado) {
            $query->where('grado_id', $grado->id);
        })->exists();

        if ($tieneMatriculas || $tieneCalificaciones || $tieneAsignaturas) {
            return redirect()->route('grados.index')->with('error', 'No se puede eliminar el grado porque tiene clases asociadas o alumnos matriculados.');
        }

        $grado->delete();

        return redirect()->route('grados.index')->with('status', 'Grado eliminado correctamente.');
    }
}
