<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Grado;
use App\Models\Matricula;
use App\Models\Project;
use App\Models\Comment;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class DashboardController extends Controller
{
    public function index()
    {
        // Fechas base
        $now = Carbon::now();
        $startOfMonth = $now->copy()->startOfMonth();
        $startOfLastMonth = $now->copy()->subMonth()->startOfMonth();
        $endOfLastMonth = $now->copy()->subMonth()->endOfMonth();

        // Alumnos
        $alumnosMesActual = Alumno::whereBetween('created_at', [$startOfMonth, $now])->count();
        $alumnosMesAnterior = Alumno::whereBetween('created_at', [$startOfLastMonth, $endOfLastMonth])->count();
        $totalAlumnos = Alumno::count();
        $alumnoCambioPorciento = $alumnosMesAnterior > 0
            ? number_format((($alumnosMesActual - $alumnosMesAnterior) / $alumnosMesAnterior) * 100, 1)
            : null;

        // Grados creados este mes
        $totalGrados = Grado::count();
        $gradosEsteMes = Grado::whereBetween('created_at', [$startOfMonth, $now])->count();

        // Matrículas del año actual
        $totalMatriculas = Matricula::whereYear('created_at', $now->year)->count();

        // Proyectos
        $totalProyectos = Project::count();
        $proyectosActivos = Project::where('status', 'activo')->count();
        $proyectosCompletados = Project::where('status', 'completado')->count();

        // Últimos comentarios
        $comments = Comment::latest()->take(10)->get();

        return view('dashboard', compact(
            'totalAlumnos',
            'alumnoCambioPorciento',
            'totalGrados',
            'gradosEsteMes',
            'totalMatriculas',
            'totalProyectos',
            'proyectosActivos',
            'proyectosCompletados',
            'comments'
        ));
    }

}
