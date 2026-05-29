<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id('id_alumno'); // Clave primaria requerida
            $table->string('nombre'); //
            $table->string('apellidos'); //
            $table->date('fecha_nacimiento'); //
            $table->string('dni', 20)->unique(); //
            $table->string('direccion')->nullable(); //
            $table->string('telefono', 20)->nullable(); //
            $table->string('email')->unique(); //
            $table->string('estado_matricula')->default('matriculado'); //
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};