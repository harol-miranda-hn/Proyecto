<?php
namespace Database\Factories;

use App\Models\Comment;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    protected $model = Comment::class;

    // Un arreglo de frases relacionadas con la informática
    private $informaticComments = [
        'El código está bien estructurado.',
        'Optimización de la base de datos.',
        '¿Usas patrones de diseño?',
        'Buen uso de la seguridad.',
        '¿Has probado esta librería?',
        'Código limpio, fácil de leer.',
        'Buen trabajo con la API.',
        '¿Qué framework utilizaste?',
        'Interesante solución al problema.',
        'La arquitectura parece robusta.',
        'El rendimiento es impresionante.',
        'Gran implementación de microservicios.',
    ];

    public function definition(): array
    {
        // Selecciona una frase al azar
        $content = $this->faker->randomElement($this->informaticComments);

        // Garantiza que la frase no tenga más de 6 palabras (en caso de que lo necesites como límite estricto)
        $content = implode(' ', array_slice(explode(' ', $content), 0, 6));

        return [
            'content' => $content,  // Frase corta relacionada con la informática
            'user_id' => User::factory()->create()->id,
            'project_id' => Project::factory()->create()->id,
        ];
    }
}
