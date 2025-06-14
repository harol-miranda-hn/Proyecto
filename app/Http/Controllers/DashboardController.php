<?php
// DashboardController.php

namespace App\Http\Controllers;

use App\Models\Comment;

class DashboardController extends Controller
{
    public function index()
    {
        // Obtener los últimos 5 comentarios, puedes ajustar el número según sea necesario
        // Obtener los últimos 5 comentarios
        $comments = Comment::latest()->take(10)->get();

        // Verificar si es una solicitud AJAX (para actualizar comentarios sin recargar la página)
        if (request()->ajax()) {
            return response()->json([
                'comments' => $comments
            ]);
        }

        return view('dashboard', compact('comments'));
    }
}
