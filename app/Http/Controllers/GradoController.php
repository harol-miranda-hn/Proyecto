<?php

namespace App\Http\Controllers;

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
            ->paginate(4)
            ->appends(['search' => $request->search]);

        return view('grados.index', compact('grados'));
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
