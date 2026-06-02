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
       $table->integer('id_profesor')->primary(); // Tu clave primaria personalizada
            $table->string('nombre', 255);
            $table->string('apellidos', 255);
            $table->string('especialidad', 255);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
