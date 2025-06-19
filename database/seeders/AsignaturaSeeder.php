<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Asignatura;

class AsignaturaSeeder extends Seeder
{
    public function run(): void
    {
        $asignaturasBase = [
            'Español', 'Matemáticas', 'Ciencias Naturales', 'Estudios Sociales', 'Inglés',
            'Educación Física', 'Computación', 'Valores', 'Artes Plásticas', 'Música'
        ];

        foreach ($asignaturasBase as $nombre) {
            Asignatura::create([
                'nombre' => $nombre,
            ]);
        }
    }
}
