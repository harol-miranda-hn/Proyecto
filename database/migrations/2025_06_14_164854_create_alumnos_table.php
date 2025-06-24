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
        Schema::create('alumnos', function (Blueprint $table) {
            $table->id();
            $table->string('numero_identidad', 13)->unique();
            $table->string('nombre_completo', 100);
            $table->string('telefono', 8)->unique();
            $table->string('direccion', 500)->nullable();
            $table->string('descripcion_enfermedad', 500)->nullable();
            $table->string('descripcion_observacion', 500)->nullable();
            $table->string('email', 100)->nullable();
            $table->date('fecha_nacimiento');
            $table->enum('genero', ['M', 'F']);
            $table->enum('parentesco', ['madre', 'padre', 'tutor', 'otro']);
            $table->string('encargado_nombre', 100);
            $table->string('encargado_telefono', 8)->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumnos');
    }
};
