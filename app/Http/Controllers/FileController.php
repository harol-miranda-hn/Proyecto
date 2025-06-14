<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $files = File::paginate(4);
        return view('files.index', compact('files'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $projects = Project::all(); // Obtiene todos los proyectos
        return view('files.create', compact('projects'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'name' => 'required|string|max:255',
            'file' => 'required|file|mimes:jpg,png,pdf,docx|max:2048',
        ]);

        $uploadedFile = $request->file('file');
        $filename = time() . '_' . $uploadedFile->getClientOriginalName();
        $filePath = $uploadedFile->storeAs('public/files', $filename);  // Se almacena en 'storage/app/public/files'

        File::create([
            'name' => $request->name,
            'path' => 'files/' . $filename,  // Guardar en la base de datos como 'files/{filename}' (sin el 'public/')
            'project_id' => $request->project_id,
        ]);


        return redirect()->route('files.index')->with('status', __('Archivo creado y subido exitosamente.'));
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

    public function download($fileId)
    {
        // Encuentra el archivo por su ID
        $file = File::findOrFail($fileId);

        // Obtén la ruta completa del archivo en storage/app/public
        $filePath = public_path('storage/' . $file->path);  // Se debe añadir 'storage/' antes del nombre del archivo

        // Verifica si el archivo existe
        if (file_exists($filePath)) {
            // Regresa el archivo para su descarga
            return response()->download($filePath, $file->name);
        }

        // Si no se encuentra el archivo, muestra un error 404
        abort(404, 'Archivo no encontrado.');
    }



}
