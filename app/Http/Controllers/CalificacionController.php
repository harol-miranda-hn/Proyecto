<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalificacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = \App\Models\Calificacion::with(['alumno', 'grado', 'asignatura']);

        if ($request->filled('search')) {
            $search = $request->search;

            $query->whereHas('alumno', function ($q) use ($search) {
                $q->where('nombre_completo', 'like', "%{$search}%");
            })->orWhereHas('asignatura', function ($q) use ($search) {
                $q->where('nombre', 'like', "%{$search}%");
            })->orWhere('tipo', 'like', "%{$search}%");
        }

        $calificaciones = $query
            ->orderByDesc('created_at')
            ->paginate(10)
            ->appends(['search' => $request->search]);

        return view('calificaciones.index', compact('calificaciones'));
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
