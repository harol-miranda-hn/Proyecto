<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GradoController;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\AsignaturaController;
use App\Http\Controllers\CalificacionController;
use App\Http\Controllers\AsignaturaGradoController;
use App\Http\Controllers\MatriculaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/usuarios', [UserController::class, 'index'])->name('users.index');
    Route::get('/usuarios/crear', [UserController::class, 'create'])->name('users.create');
    Route::post('/usuarios', [UserController::class, 'store'])->name('users.store');
    Route::get('/usuarios/{user}', [UserController::class, 'show'])->name('users.show');
    Route::get('/usuarios/{user}/editar', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/usuarios/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

    Route::get('/proyectos', [ProjectController::class, 'index'])->name('projects.index'); // Mostrar todos los proyectos
    Route::get('/proyectos/crear', [ProjectController::class, 'create'])->name('projects.create'); // Formulario para crear un nuevo proyecto
    Route::post('/proyectos', [ProjectController::class, 'store'])->name('projects.store'); // Almacenar un nuevo proyecto
    Route::get('/proyectos/{project}', [ProjectController::class, 'show'])->name('projects.show'); // Mostrar un proyecto específico
    Route::get('/proyectos/{project}/editar', [ProjectController::class, 'edit'])->name('projects.edit'); // Formulario para editar un proyecto
    Route::put('/proyectos/{project}', [ProjectController::class, 'update'])->name('projects.update'); // Actualizar un proyecto existente
    Route::delete('/projects/{id}', [CommentController::class, 'destroy'])->name('comments.destroy'); // Eliminar un comentario

    Route::get('/comentarios', [CommentController::class, 'index'])->name('comments.index'); // Mostrar todos los comentarios
    Route::get('/comentarios/crear', [CommentController::class, 'create'])->name('comments.create'); // Formulario para crear un nuevo comentario
    Route::post('/comentarios', [CommentController::class, 'store'])->name('comments.store'); // Almacenar un nuevo comentario
    Route::get('/comentarios/{comment}', [CommentController::class, 'show'])->name('comments.show'); // Mostrar un comentario específico
    Route::get('/comentarios/{comment}/editar', [CommentController::class, 'edit'])->name('comments.edit'); // Formulario para editar un comentario
    Route::put('/comentarios/{comment}', [CommentController::class, 'update'])->name('comments.update'); // Actualizar un comentario
    Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->name('comments.destroy'); // Eliminar un comentario

    // Rutas para archivos
    Route::get('/archivos', [FileController::class, 'index'])->name('files.index'); // Listar archivos
    Route::get('/archivos/crear', [FileController::class, 'create'])->name('files.create'); // Formulario para crear archivo
    Route::post('/archivos', [FileController::class, 'store'])->name('files.store'); // Subir archivo
    Route::get('/archivos/{file}', [FileController::class, 'show'])->name('files.show'); // Ver archivo
    Route::get('/files/{file}', [FileController::class, 'download'])->name('files.download'); // Descargar archivo

    Route::get('/grados', [GradoController::class, 'index'])->name('grados.index');
    Route::get('/grados/crear', [GradoController::class, 'create'])->name('grados.create');
    Route::post('/grados', [GradoController::class, 'store'])->name('grados.store');
    Route::get('/grados/{grado}', [GradoController::class, 'show'])->name('grados.show');
    Route::get('/grados/{grado}/editar', [GradoController::class, 'edit'])->name('grados.edit');
    Route::put('/grados/{grado}', [GradoController::class, 'update'])->name('grados.update');
    Route::delete('/grados/{grado}', [GradoController::class, 'destroy'])->name('grados.destroy');

    Route::get('/alumnos', [AlumnoController::class, 'index'])->name('alumnos.index');
    Route::get('/alumnos/crear', [AlumnoController::class, 'create'])->name('alumnos.create');
    Route::post('/alumnos', [AlumnoController::class, 'store'])->name('alumnos.store');
    Route::get('/alumnos/{alumno}', [AlumnoController::class, 'show'])->name('alumnos.show');
    Route::get('/alumnos/{alumno}/editar', [AlumnoController::class, 'edit'])->name('alumnos.edit');
    Route::put('/alumnos/{alumno}', [AlumnoController::class, 'update'])->name('alumnos.update');
    Route::delete('/alumnos/{alumno}', [AlumnoController::class, 'destroy'])->name('alumnos.destroy');

    Route::get('/asignaturas', [AsignaturaController::class, 'index'])->name('asignaturas.index');
    Route::get('/asignaturas/crear', [AsignaturaController::class, 'create'])->name('asignaturas.create');
    Route::post('/asignaturas', [AsignaturaController::class, 'store'])->name('asignaturas.store');
    Route::get('/asignaturas/{asignatura}', [AsignaturaController::class, 'show'])->name('asignaturas.show');
    Route::get('/asignaturas/{asignatura}/editar', [AsignaturaController::class, 'edit'])->name('asignaturas.edit');
    Route::put('/asignaturas/{asignatura}', [AsignaturaController::class, 'update'])->name('asignaturas.update');
    Route::delete('/asignaturas/{asignatura}', [AsignaturaController::class, 'destroy'])->name('asignaturas.destroy');

    Route::get('/calificaciones', [CalificacionController::class, 'index'])->name('calificaciones.index');
    Route::get('/calificaciones/crear', [CalificacionController::class, 'create'])->name('calificaciones.create');
    Route::post('/calificaciones', [CalificacionController::class, 'store'])->name('calificaciones.store');
    Route::get('/calificaciones/{calificacion}', [CalificacionController::class, 'show'])->name('calificaciones.show');
    Route::get('/calificaciones/{calificacion}/editar', [CalificacionController::class, 'edit'])->name('calificaciones.edit');
    Route::put('/calificaciones/{calificacion}', [CalificacionController::class, 'update'])->name('calificaciones.update');
    Route::delete('/calificaciones/{id}', [CalificacionController::class, 'destroy'])->name('calificaciones.destroy');

    Route::get('/asignaciones', [AsignaturaGradoController::class, 'index'])->name('asignaciones.index');
    Route::get('/grados/{grado}/asignaturas', [AsignaturaGradoController::class, 'edit'])->name('grados.asignaturas.edit');
    Route::put('/grados/{grado}/asignaturas', [AsignaturaGradoController::class, 'update'])->name('grados.asignaturas.update');

    // Mostrar formulario para asignar asignaturas a un grado
    Route::get('/grados/{grado}/asignaturas', [AsignaturaGradoController::class, 'edit'])->name('grados.asignaturas.edit');

    // Guardar asignaturas asignadas a un grado
    Route::post('/grados/{grado}/asignaturas', [AsignaturaGradoController::class, 'update'])->name('grados.asignaturas.update');

    Route::resource('matriculas', MatriculaController::class);


    // Mostrar formulario para matricular alumnos en un grado
    Route::get('/matriculas/create', [MatriculaController::class, 'create'])->name('matriculas.create');

    // Guardar la matrícula
    Route::post('/matriculas', [MatriculaController::class, 'store'])->name('matriculas.store');

    // Listar matrículas existentes
    Route::get('/matriculas', [MatriculaController::class, 'index'])->name('matriculas.index');

    // Ver detalles de una matrícula
    Route::get('/matriculas/{matricula}', [MatriculaController::class, 'show'])->name('matriculas.show');

    // Editar una matrícula (por si hay cambio de grado, etc.)
    Route::get('/matriculas/{matricula}/editar', [MatriculaController::class, 'edit'])->name('matriculas.edit');
    Route::put('/matriculas/{matricula}', [MatriculaController::class, 'update'])->name('matriculas.update');

    // Eliminar una matrícula
    Route::delete('/matriculas/{matricula}', [MatriculaController::class, 'destroy'])->name('matriculas.destroy');

    //Ver calificaciones por alumno y grado
    Route::get('/alumnos/{alumno}/calificaciones/{grado}', [CalificacionController::class, 'verPorAlumnoYGrado'])->name('calificaciones.alumno.grado');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

require __DIR__.'/auth.php';
