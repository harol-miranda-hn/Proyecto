<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Alumno;

class AlumnoSeeder extends Seeder
{
    public function run(): void
    {
        $alumnos = [
            ['numero_identidad' => '0801199912345', 'nombre_completo' => 'Carlos Mejía', 'grado_id' => 1],
            ['numero_identidad' => '0801199912346', 'nombre_completo' => 'Ana López', 'grado_id' => 1],
            ['numero_identidad' => '0801199912347', 'nombre_completo' => 'Luis Torres', 'grado_id' => 2],
            ['numero_identidad' => '0801199912348', 'nombre_completo' => 'Sofía Rivera', 'grado_id' => 3],
            ['numero_identidad' => '0801199912349', 'nombre_completo' => 'Pedro Suazo', 'grado_id' => 3],
        ];

        foreach ($alumnos as $i => $data) {
            Alumno::create([
                'numero_identidad' => $data['numero_identidad'],
                'nombre_completo' => $data['nombre_completo'],
                'telefono' => '9988776' . $i,
                'encargado_nombre' => 'Encargado ' . $i,
                'encargado_telefono' => '8877665' . $i,
                'grado_id' => $data['grado_id'],
                'padece_enfermedad' => false,
                'tiene_observaciones' => false,
                'fecha_matricula' => now(),
            ]);
        }
    }
}
