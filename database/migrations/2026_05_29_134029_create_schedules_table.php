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
        Schema::create('schedules', function (Blueprint $table) {
Schema::create('schedules', function (Blueprint $table) {
            // Usamos la llave primaria autoincremental estándar de Laravel
            $table->id(); 

            // Llave foránea limpia enlazada a la tabla courses
            $table->foreignId('id_curso')
                  ->constrained('courses', 'id_curso')
                  ->onDelete('cascade');

            $table->dateTime('weekday');
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->string('num_salon', 10); // Límite de caracteres para el salón
            $table->timestamps();
        });
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
