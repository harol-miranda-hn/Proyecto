<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Grado;

class GradoSeeder extends Seeder
{
    public function run(): void
    {
        Grado::create(['curso' => 'Décimo','modalidad' => 'Bachillerato Técnico Profesional en Informática', 'jornada' => 'Matutina', 'seccion' => 'A']);
        Grado::create(['curso' => 'Undécimo','modalidad' => 'Bachillerato Técnico Profesional en Informática', 'jornada' => 'Matutina', 'seccion' => 'A']);
        Grado::create(['curso' => 'Duodécimo','modalidad' => 'Bachillerato Técnico Profesional en Informática', 'jornada' => 'Matutina', 'seccion' => 'A']);

        Grado::create(['curso' => 'Décimo','modalidad' => 'Bachillerato Técnico Profesional en Informática', 'jornada' => 'Vespertina', 'seccion' => 'B']);
        Grado::create(['curso' => 'Undécimo','modalidad' => 'Bachillerato Técnico Profesional en Informática', 'jornada' => 'Vespertina', 'seccion' => 'B']);
        Grado::create(['curso' => 'Duodécimo','modalidad' => 'Bachillerato Técnico Profesional en Informática', 'jornada' => 'Vespertina', 'seccion' => 'B']);

        Grado::create(['curso' => 'Décimo','modalidad' => 'Bachillerato Técnico Profesional en Informática con orientación a robótica', 'jornada' => 'Matutina', 'seccion' => 'A']);
        Grado::create(['curso' => 'Undécimo','modalidad' => 'Bachillerato Técnico Profesional en Informática con orientación a robótica', 'jornada' => 'Matutina', 'seccion' => 'A']);
        Grado::create(['curso' => 'Duodécimo','modalidad' => 'Bachillerato Técnico Profesional en Informática con orientación a robótica', 'jornada' => 'Matutina', 'seccion' => 'A']);

        Grado::create(['curso' => 'Décimo','modalidad' => 'Bachillerato Técnico Profesional en Informática con orientación a robótica', 'jornada' => 'Matutina', 'seccion' => 'A']);
        Grado::create(['curso' => 'Undécimo','modalidad' => 'Bachillerato Técnico Profesional en Informática con orientación a robótica', 'jornada' => 'Matutina', 'seccion' => 'A']);
        Grado::create(['curso' => 'Duodécimo','modalidad' => 'Bachillerato Técnico Profesional en Informática con orientación a robótica', 'jornada' => 'Matutina', 'seccion' => 'A']);
    }
}
