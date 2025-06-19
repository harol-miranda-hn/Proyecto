<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('matriculas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('alumno_id');
            $table->unsignedBigInteger('grado_id');
            $table->date('fecha_matricula');
            $table->timestamps();

            $table->foreign('alumno_id')->references('id')->on('alumnos')->onDelete('cascade');
            $table->foreign('grado_id')->references('id')->on('grados')->onDelete('cascade');

            $table->unique(['alumno_id', 'grado_id']); // Un alumno no puede estar en el mismo grado dos veces
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matriculas');
    }
};
