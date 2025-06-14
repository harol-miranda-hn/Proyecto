<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comments = Comment::paginate(4);
        return view('comments.index', compact('comments'));
    }

    public function create()
    {
        // Obtener todos los usuarios y proyectos para la selección
        $users = User::all(); // o puedes agregar un filtro si lo necesitas
        $projects = Project::all(); // o puedes agregar un filtro si lo necesitas

        return view('comments.create', compact('users', 'projects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación
        $request->validate([
            'content' => 'required|string|min:5|max:1000',
            'project_id' => 'required|exists:projects,id',
            'user_id' => 'required|exists:users,id',
        ], [
            'content.required' => 'El contenido del comentario es obligatorio.',
            'content.string' => 'El contenido del comentario debe ser una cadena de texto.',
            'content.max' => 'El contenido del comentario no puede exceder los 1000 caracteres.',
            'content.min' => 'El contenido del comentario debe tener al menos 5 caracteres.',
            'project_id.required' => 'El proyecto asociado es obligatorio.',
            'project_id.exists' => 'El proyecto seleccionado no existe.',
            'user_id.required' => 'El usuario asociado es obligatorio.',
            'user_id.exists' => 'El usuario seleccionado no existe.',
        ]);

        // Crear el comentario
        $comment = Comment::create([
            'content' => $request->content,
            'user_id' => auth()->id(),
            'project_id' => $request->project_id,
        ]);

        return redirect()->route('comments.index')->with('status', 'Comentario creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        return view('comments.show', compact('comment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $comment = Comment::findOrFail($id);
        $users = User::all();  // Puedes filtrar los usuarios si es necesario
        $projects = Project::all();  // Lo mismo para los proyectos

        return view('comments.edit', compact('comment', 'users', 'projects'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        // Validación de los datos enviados
        $request->validate([
            'content' => 'required|string|max:1000', // El contenido es obligatorio, debe ser una cadena y no exceder 1000 caracteres
        ], [
            'content.required' => 'El contenido del comentario es obligatorio.',
            'content.string' => 'El contenido del comentario debe ser una cadena de texto.',
            'content.max' => 'El contenido del comentario no puede exceder los 1000 caracteres.',
        ]);

        // Verificación de si el usuario tiene permiso para actualizar este comentario
        // Esto es opcional, pero es importante asegurarse de que el comentario pertenece al usuario
        if ($comment->user_id != auth()->id()) {
            return redirect()->route('comments.index')->with('error', 'No tienes permisos para editar este comentario.');
        }

        // Actualizar el comentario con los nuevos datos
        $comment->update([
            'content' => $request->content
        ]);

        // Redirigir con un mensaje de éxito
        return redirect()->route('comments.index')->with('status', 'Comentario actualizado exitosamente.');
    }


    /**
     * Remove the specified resource from storage.
     */

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return redirect()->route('comments.index')->with('status', 'Comentario eliminado correctamente.');
    }
}
