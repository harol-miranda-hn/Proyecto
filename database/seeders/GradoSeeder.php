<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Grado;

class GradoSeeder extends Seeder
{
    public function run(): void
    {
        Grado::create(['nombre' => 'Primero', 'jornada' => 'Matutina', 'seccion' => 'A']);
        Grado::create(['nombre' => 'Primero', 'jornada' => 'Matutina', 'seccion' => 'B']);
        Grado::create(['nombre' => 'Segundo', 'jornada' => 'Matutina', 'seccion' => 'A']);
        Grado::create(['nombre' => 'Sexto',   'jornada' => 'Vespertina', 'seccion' => 'A']);
        Grado::create(['nombre' => 'Sexto',   'jornada' => 'Vespertina', 'seccion' => 'B']);
        Grado::create(['nombre' => 'Sexto',   'jornada' => 'Nocturna', 'seccion' => 'C']);
    }
}
