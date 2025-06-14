<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Asignatura;
use App\Models\Alumno;

class AsignaturaSeeder extends Seeder
{
    public function run(): void
    {
        $asignaturasBase = [
            'Español', 'Matemáticas', 'Ciencias Naturales', 'Estudios Sociales', 'Inglés',
            'Educación Física', 'Computación', 'Valores', 'Artes Plásticas', 'Música'
        ];

        foreach (Alumno::all() as $alumno) {
            foreach ($asignaturasBase as $nombre) {
                Asignatura::create([
                    'nombre' => $nombre,
                    'alumno_id' => $alumno->numero_identidad,
                ]);
            }
        }
    }
}
