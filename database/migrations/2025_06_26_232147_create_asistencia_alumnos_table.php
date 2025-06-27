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
        Schema::create('asistencia_alumnos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('asistencia_id');
            $table->unsignedBigInteger('alumno_id');
            $table->enum('estado', ['asistio', 'falto', 'excusado']);
            $table->foreign('asistencia_id')->references('id')->on('asistencias')->onDelete('cascade');
            $table->foreign('alumno_id')->references('id')->on('alumnos')->onDelete('cascade');
            $table->unique(['asistencia_id', 'alumno_id']); // Evita duplicados por alumno en la misma asistencia
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asistencia_alumnos');
    }
};
