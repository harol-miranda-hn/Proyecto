<?php

namespace App\Http\Controllers;

use App\Models\Asignatura;
use App\Models\Grado;
use Illuminate\Http\Request;

class AsignaturaGradoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $grados = Grado::with('asignaturas')->paginate(4); // Paginación de 4
        return view('asignatura_grado.index', compact('grados'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($gradoId)
    {
        $grado = Grado::with('asignaturas')->findOrFail($gradoId);
        $asignaturas = Asignatura::all();

        return view('asignatura_grado.edit', compact('grado', 'asignaturas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $gradoId)
    {
        $grado = Grado::findOrFail($gradoId);

        // Sincroniza las asignaturas seleccionadas con la tabla pivot
        $grado->asignaturas()->sync($request->asignaturas ?? []);

        return redirect()->route('asignaciones.index')->with('status', 'Asignaturas actualizadas correctamente.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
