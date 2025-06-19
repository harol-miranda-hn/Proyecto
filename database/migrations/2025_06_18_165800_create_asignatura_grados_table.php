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
        Schema::create('asignatura_grado', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('grado_id');
            $table->unsignedBigInteger('asignatura_id');
            $table->timestamps();

            $table->foreign('grado_id')->references('id')->on('grados')->onDelete('cascade');
            $table->foreign('asignatura_id')->references('id')->on('asignaturas')->onDelete('cascade');

            $table->unique(['grado_id', 'asignatura_id']); // Evita duplicados
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asignatura_grados');
    }
};
