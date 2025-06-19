<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Alumno;

class AlumnoSeeder extends Seeder
{
    public function run(): void
    {
        $alumnos = [
            ['numero_identidad' => '0801199912345', 'nombre_completo' => 'Carlos Alberto Mejía Juarez', 'direccion' => 'Colonia Manuel Zelaya'],
            ['numero_identidad' => '0801199912346', 'nombre_completo' => 'Ana Corina López Rodriguez', 'direccion' => 'Colonia Manuel Zelaya'],
            ['numero_identidad' => '0801199912347', 'nombre_completo' => 'Luis Antonio Torres', 'direccion' => 'Colonia Manuel Zelaya'],
            ['numero_identidad' => '0801199912348', 'nombre_completo' => 'Sofía Alejandra Rivera Maradiaga', 'direccion' => 'Colonia Manuel Zelaya'],
            ['numero_identidad' => '0801199912349', 'nombre_completo' => 'Pedro Pablo Escobar Suazo', 'direccion' => 'Colonia Manuel Zelaya'],
        ];

        foreach ($alumnos as $i => $data) {
            Alumno::create([
                'numero_identidad' => $data['numero_identidad'],
                'nombre_completo' => $data['nombre_completo'],
                'telefono' => '9988776' . $i,
                'encargado_nombre' => 'Encargado ' . $i,
                'encargado_telefono' => '8877665' . $i,
                'padece_enfermedad' => false,
                'tiene_observaciones' => false,
                'fecha_matricula' => now(),
            ]);
        }
    }
}
