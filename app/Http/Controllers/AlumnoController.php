<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use Illuminate\Http\Request;

class AlumnoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Alumno::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('nombre_completo', 'like', "%{$search}%");
        }

        $alumnos = $query->orderBy('nombre_completo')
            ->paginate(5)
            ->appends(['search' => $request->search]); // Mantener búsqueda en paginación

        return view('alumnos.index', compact('alumnos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('alumnos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'numero_identidad'        => ['required', 'digits:13', 'unique:alumnos,numero_identidad'],
            'nombre_completo'         => ['required', 'string', 'max:100'],
            'email'                   => ['nullable', 'email', 'max:100'],
            'telefono'                => ['required', 'digits:8', 'unique:alumnos,telefono'],
            'fecha_nacimiento'        => ['required', 'date'],
            'genero'                  => ['required', 'in:M,F'],
            'direccion'               => ['nullable', 'string', 'max:500'],
            'descripcion_enfermedad'  => ['nullable', 'string', 'max:500'],
            'descripcion_observacion' => ['nullable', 'string', 'max:500'],
            'encargado_nombre'        => ['required', 'string', 'max:100'],
            'encargado_telefono'      => ['required', 'digits:8', 'unique:alumnos,encargado_telefono'],
            'parentesco'              => ['required', 'in:madre,padre,tutor,otro'],
        ], [
            'numero_identidad.required' => 'El número de identidad es obligatorio.',
            'numero_identidad.digits' => 'El número de identidad debe tener exactamente 13 dígitos.',
            'numero_identidad.unique' => 'Este número de identidad ya está registrado.',

            'nombre_completo.required' => 'El nombre completo es obligatorio.',
            'nombre_completo.max' => 'El nombre completo no debe exceder 100 caracteres.',

            'telefono.required' => 'El teléfono del alumno es obligatorio.',
            'telefono.digits' => 'El teléfono debe tener exactamente 8 dígitos.',
            'telefono.unique' => 'Este número de teléfono ya está registrado.',

            'encargado_nombre.required' => 'El nombre del encargado es obligatorio.',
            'encargado_nombre.max' => 'El nombre del encargado no debe exceder 100 caracteres.',

            'encargado_telefono.required' => 'El teléfono del encargado es obligatorio.',
            'encargado_telefono.digits' => 'El teléfono del encargado debe tener exactamente 8 dígitos.',
            'encargado_telefono.unique' => 'Este teléfono del encargado ya está registrado.',

            'descripcion_enfermedad.max' => 'La descripción de la enfermedad no debe exceder 500 caracteres.',
            'descripcion_observacion.max' => 'La descripción de la observación no debe exceder 500 caracteres.',

            'direccion.max' => 'La dirección no debe exceder 500 caracteres.',

            'email.email' => 'Ingrese un correo electrónico válido.',
            'email.max' => 'El correo electrónico no debe exceder 100 caracteres.',

            'fecha_nacimiento.required' => 'La fecha de nacimiento es obligatoria.',

            'genero.required' => 'El género es obligatorio.',
            'genero.in' => 'El género debe ser Masculino o Femenino.',

            'parentesco.required' => 'El parentesco es obligatorio.',
            'parentesco.in' => 'Seleccione una opción válida de parentesco.',
        ]);

        Alumno::create($validated);

        return redirect()->route('alumnos.index')->with('status', 'Alumno registrado exitosamente.');
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
