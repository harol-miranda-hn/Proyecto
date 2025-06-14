<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Generamos un nombre completo, pero dependiendo del rol cambiamos el correo
        $name = $this->faker->firstName . ' ' . $this->faker->lastName;

        // Si es profesor, añadimos un título (MSc., PhD., Lic., Ing., etc.)
        $role = $this->faker->randomElement(['estudiante', 'profesor']);
        if ($role == 'profesor') {
            $prefix = $this->faker->randomElement(['MSc.', 'PhD.', 'Lic.', 'Ing.']);
            $name = $prefix . ' ' . $name;  // Agregar título profesional al nombre
        }

        // Generamos el correo en función del rol
        $email = ($role == 'profesor')
            ? $this->generateProfessorEmail($name)  // Para profesores, usamos un correo con el título
            : $this->generateStudentEmail($name);   // Para estudiantes, usamos solo nombre y apellido

        return [
            'name' => $name,
            'email' => $email,
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'role' => $role,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    /**
     * Generar un correo de profesor con el título y un dominio académico.
     *
     * @param string $name
     * @return string
     */
    private function generateProfessorEmail(string $name): string
    {
        $nameParts = explode(' ', $name);
        $firstName = strtolower($nameParts[1]);  // Usamos el apellido como primer nombre para el correo
        $lastName = strtolower($nameParts[2]);  // Usamos el apellido para el correo

        // Usamos un dominio académico ficticio
        return $firstName . '.' . $lastName . '@academia.edu';
    }

    /**
     * Generar un correo de estudiante con nombre y apellido.
     *
     * @param string $name
     * @return string
     */
    private function generateStudentEmail(string $name): string
    {
        $nameParts = explode(' ', $name);
        $firstName = strtolower($nameParts[0]);  // Usamos el primer nombre
        $lastName = strtolower($nameParts[1]);  // Usamos el apellido

        // Dominio genérico de estudiantes
        return $firstName . '.' . $lastName . '@estudiante.com';
    }
}
