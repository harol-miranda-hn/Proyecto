<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Calificacion;
use App\Models\Asignatura;

class CalificacionSeeder extends Seeder
{
    public function run(): void
    {
        foreach (Asignatura::all() as $asignatura) {
            $notaBase = rand(60, 95);
            $isRecovery = $asignatura->alumno->numero_identidad === '0801199912345' &&
                in_array($asignatura->nombre, ['Matemáticas', 'Inglés']);

            // Parciales
            foreach (['Parcial 1', 'Parcial 2', 'Parcial 3'] as $tipo) {
                Calificacion::create([
                    'asignatura_id' => $asignatura->id,
                    'tipo' => $tipo,
                    'nota' => $isRecovery ? rand(55, 65) : rand(70, 95),
                ]);
            }

            // Recuperación si corresponde
            if ($isRecovery) {
                Calificacion::create([
                    'asignatura_id' => $asignatura->id,
                    'tipo' => 'Recuperación',
                    'nota' => rand(70, 85),
                ]);
            }
        }
    }
}
