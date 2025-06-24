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
