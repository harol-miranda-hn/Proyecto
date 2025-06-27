<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::paginate(4);
        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $students = User::where('role', 'estudiante')->get();
        $professors = User::where('role', 'profesor')->get();
        return view('projects.create', compact('students', 'professors'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación de los datos recibidos con mensajes personalizados
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'student_id' => 'required|exists:users,id|different:professor_id',
            'professor_id' => 'required|exists:users,id|different:student_id',
            'status' => 'required|in:activo,completado',
        ], [
            // Mensajes personalizados
            'name.required' => 'El nombre del proyecto es obligatorio.',
            'name.string' => 'El nombre del proyecto debe ser una cadena de texto.',
            'name.max' => 'El nombre del proyecto no puede tener más de 255 caracteres.',

            'description.required' => 'La descripción del proyecto es obligatoria.',
            'description.string' => 'La descripción debe ser una cadena de texto.',
            'description.max' => 'La descripción no puede tener más de 1000 caracteres.',

            'student_id.required' => 'Debe seleccionar un estudiante para el proyecto.',
            'student_id.exists' => 'El estudiante seleccionado no existe en el sistema.',
            'student_id.different' => 'El estudiante no puede ser el mismo que el profesor.',

            'professor_id.required' => 'Debe seleccionar un profesor para el proyecto.',
            'professor_id.exists' => 'El profesor seleccionado no existe en el sistema.',
            'professor_id.different' => 'El profesor no puede ser el mismo que el estudiante.',

            'status.required' => 'Debe seleccionar el estado del proyecto.',
            'status.in' => 'El estado del proyecto debe ser "activo" o "completado".',
        ]);

        // Crear el proyecto
        $project = Project::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'student_id' => $validated['student_id'],
            'professor_id' => $validated['professor_id'],
            'status' => $validated['status'],
        ]);

        // Redirigir con un mensaje de éxito
        return redirect()->route('projects.index')->with('status', __('Proyecto creado exitosamente'));
    }


    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Recuperar el proyecto a editar
        $project = Project::findOrFail($id);

        // Obtener la lista de estudiantes y profesores
        $students = User::where('role', 'estudiante')->get();
        $professors = User::where('role', 'profesor')->get();

        // Devolver la vista con el proyecto y las listas
        return view('projects.edit', compact('project', 'students', 'professors'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validación de los datos recibidos con mensajes personalizados
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'student_id' => 'required|exists:users,id|different:professor_id',
            'professor_id' => 'required|exists:users,id|different:student_id',
            'status' => 'required|in:activo,completado',
        ], [
            // Mensajes personalizados
            'name.required' => 'El nombre del proyecto es obligatorio.',
            'name.string' => 'El nombre del proyecto debe ser una cadena de texto.',
            'name.max' => 'El nombre del proyecto no puede tener más de 255 caracteres.',

            'description.required' => 'La descripción del proyecto es obligatoria.',
            'description.string' => 'La descripción debe ser una cadena de texto.',
            'description.max' => 'La descripción no puede tener más de 1000 caracteres.',

            'student_id.required' => 'Debe seleccionar un estudiante para el proyecto.',
            'student_id.exists' => 'El estudiante seleccionado no existe en el sistema.',
            'student_id.different' => 'El estudiante no puede ser el mismo que el profesor.',

            'professor_id.required' => 'Debe seleccionar un profesor para el proyecto.',
            'professor_id.exists' => 'El profesor seleccionado no existe en el sistema.',
            'professor_id.different' => 'El profesor no puede ser el mismo que el estudiante.',

            'status.required' => 'Debe seleccionar el estado del proyecto.',
            'status.in' => 'El estado del proyecto debe ser "activo" o "completado".',
        ]);


        // Encontrar el proyecto a actualizar
        $project = Project::findOrFail($id);

        // Actualizar el proyecto con los datos validados
        $project->update([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'student_id' => $validated['student_id'],
            'professor_id' => $validated['professor_id'],
            'status' => $validated['status'],
        ]);

        // Redirigir con un mensaje de éxito
        return redirect()->route('projects.index')->with('status', __('Proyecto actualizado exitosamente'));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $project = Project::findOrFail($id);

        // Verificar si el proyecto tiene comentarios
        if ($project->comments()->exists()) {
            return redirect()->route('projects.index')
                ->with('error', 'No se puede eliminar el proyecto porque tiene comentarios asignados.');
        }

        $project->delete();

        return redirect()->route('projects.index')
            ->with('status', 'Proyecto eliminado correctamente.');
    }

}
