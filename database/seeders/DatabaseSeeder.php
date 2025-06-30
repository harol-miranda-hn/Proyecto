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
        $this->call([
            UserSeeder::class,
            GradoSeeder::class,
            AsignaturaSeeder::class,
            AlumnoSeeder::class,
        ]);

    }
}
