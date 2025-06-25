<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('calificaciones', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('matricula_id');      // Relaciona alumno con grado
            $table->unsignedBigInteger('asignatura_id');     // Relaciona con asignatura asignada al grado

            $table->decimal('parcial_1', 5, 2)->nullable();
            $table->decimal('parcial_2', 5, 2)->nullable();
            $table->decimal('parcial_3', 5, 2)->nullable();
            $table->decimal('parcial_4', 5, 2)->nullable();

            $table->timestamps();

            // Llaves foráneas
            $table->foreign('matricula_id')->references('id')->on('matriculas')->onDelete('cascade');
            $table->foreign('asignatura_id')->references('id')->on('asignaturas')->onDelete('cascade');

            // Un alumno no puede tener más de una calificación para la misma asignatura dentro de la misma matrícula
            $table->unique(['matricula_id', 'asignatura_id'], 'matricula_asignatura_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('calificaciones');
    }
};
