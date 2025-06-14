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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->foreignId('student_id')->constrained('users')->onDelete('cascade'); // Relación con los estudiantes
            $table->foreignId('professor_id')->constrained('users')->onDelete('cascade'); // Relación con los profesores
            $table->enum('status', ['activo', 'completado']); // Estado del proyecto
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
