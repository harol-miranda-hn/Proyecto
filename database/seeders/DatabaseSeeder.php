<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Project;
use App\Models\File;
use App\Models\Comment;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);

        // Crear 10 usuarios
        User::factory(1)->create();

        // Crear 5 proyectos
        Project::factory(1)->create();

        // Crear 10 archivos asociados a proyectos
        File::factory(1)->create();

        // Crear 20 comentarios asociados a proyectos
        Comment::factory(2)->create();

        $this->call([
            GradoSeeder::class,
            AlumnoSeeder::class,
            AsignaturaSeeder::class,
            CalificacionSeeder::class,
        ]);

    }
}
