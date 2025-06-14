<?php
namespace Database\Factories;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    protected $model = Project::class;

    public function definition(): array
    {
        return [
            // Nombres más realistas y enfocados en informática
            'name' => $this->faker->randomElement([
                'Desarrollo de App Móvil',
                'Análisis de Datos con Python',
                'Sistema de Gestión Web',
                'Redes Neuronales Artificiales',
                'Desarrollo de Software de Seguridad',
                'Investigación en Inteligencia Artificial',
                'Desarrollo de Videojuegos 3D',
                'Estudio de Algoritmos de Búsqueda',
            ]),

            // Descripciones más breves y específicas
            'description' => $this->faker->randomElement([
                'Este proyecto busca crear una app móvil para gestión de tareas.',
                'Desarrollo de un sistema para análisis de grandes volúmenes de datos.',
                'Implementación de un sistema web para gestión de proyectos académicos.',
                'Investigación sobre el uso de redes neuronales para clasificación de datos.',
                'Desarrollo de software para mejorar la seguridad en redes de computadoras.',
                'Investigación sobre los avances actuales en IA y aprendizaje automático.',
                'Desarrollo de un videojuego en 3D utilizando motores gráficos modernos.',
                'Estudio y optimización de algoritmos de búsqueda para grandes bases de datos.',
            ]),

            'student_id' => User::factory()->create()->id,
            'professor_id' => User::factory()->create()->id,
            'status' => $this->faker->randomElement(['activo', 'completado']),
        ];
    }
}
