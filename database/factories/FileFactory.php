<?php
namespace Database\Factories;

use App\Models\File;
use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

class FileFactory extends Factory
{
    protected $model = File::class;

    // Un arreglo de nombres relacionados con la informática
    private $informaticTerms = [
        'Algoritmo', 'Base de Datos', 'Red', 'Servidor', 'Sistema Operativo',
        'Inteligencia Artificial', 'Ciberseguridad', 'Cloud Computing', 'Blockchain', 'IoT'
    ];

    public function definition(): array
    {
        // Crear un número romano aleatorio (esto lo haremos manualmente)
        $romanNumeral = $this->generateRomanNumeral(rand(1, 12)); // Numeración romana de 1 a 12

        // Elegir un término informático al azar
        $term = $this->faker->randomElement($this->informaticTerms);

        // Crear el nombre del proyecto con el término y numeración romana
        $projectName = "{$term} {$romanNumeral}";

        return [
            'name' => $projectName,
            'path' => 'files/proyecto.jpg',  // Este sería el nombre del archivo (puedes personalizarlo más)
            'project_id' => Project::factory()->create()->id,  // Creación de un proyecto relacionado
        ];
    }

    /**
     * Función para generar numeración romana.
     *
     * @param int $number
     * @return string
     */
    private function generateRomanNumeral(int $number): string
    {
        $romanNumerals = [
            1 => 'I', 2 => 'II', 3 => 'III', 4 => 'IV', 5 => 'V',
            6 => 'VI', 7 => 'VII', 8 => 'VIII', 9 => 'IX', 10 => 'X',
            11 => 'XI', 12 => 'XII'
        ];

        return $romanNumerals[$number] ?? '';
    }
}
