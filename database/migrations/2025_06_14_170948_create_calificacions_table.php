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

            $table->unsignedBigInteger('asignatura_id');
            $table->enum('tipo', ['Parcial 1', 'Parcial 2', 'Parcial 3', 'Recuperación']);
            $table->decimal('nota', 5, 2);

            $table->foreign('asignatura_id')->references('id')->on('asignaturas')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('calificaciones');
    }
};
