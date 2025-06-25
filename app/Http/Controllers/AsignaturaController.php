<?php

namespace App\Http\Controllers;

use App\Models\Asignatura;
use App\Models\Alumno;
use Illuminate\Http\Request;

class AsignaturaController extends Controller
{
    public function index(Request $request)
    {
        $query = Asignatura::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('nombre', 'like', "%{$search}%");
        }

        $asignaturas = $query->orderBy('nombre')
            ->paginate(5)
            ->appends(['search' => $request->search]);

        return view('asignaturas.index', compact('asignaturas'));
    }


    /**
     * Show the form for creating a new resource.
     */
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('asignaturas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => ['required', 'string', 'max:100', 'unique:asignaturas,nombre'],
        ], [
            'nombre.required' => 'El nombre de la asignatura es obligatorio.',
            'nombre.max' => 'El nombre no debe exceder 100 caracteres.',
            'nombre.unique' => 'Esta asignatura ya está registrada.',
        ]);

        Asignatura::create($validated);

        return redirect()->route('asignaturas.index')->with('status', 'Asignatura registrada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Asignatura $asignatura)
    {
        return view('asignaturas.show', compact('asignatura'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Asignatura $asignatura)
    {
        return view('asignaturas.edit', compact('asignatura'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Asignatura $asignatura)
    {
        $validated = $request->validate([
            'nombre' => ['required', 'string', 'max:100', 'unique:asignaturas,nombre,' . $asignatura->id],
        ], [
            'nombre.required' => 'El nombre de la asignatura es obligatorio.',
            'nombre.max' => 'El nombre no debe exceder 100 caracteres.',
            'nombre.unique' => 'Ya existe una asignatura con ese nombre.',
        ]);

        $asignatura->update($validated);

        return redirect()->route('asignaturas.index')->with('status', 'Asignatura actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $asignatura = Asignatura::findOrFail($id);

        $tieneCalificaciones = $asignatura->calificaciones()->exists();
        $tieneGrados = $asignatura->grados()->exists();

        if ($tieneCalificaciones || $tieneGrados) {
            return redirect()->route('asignaturas.index')->with('error', 'No se puede eliminar la asignatura porque está asociada a otros registros.');
        }

        $asignatura->delete();

        return redirect()->route('asignaturas.index')->with('status', 'Asignatura eliminada correctamente.');
    }
}
