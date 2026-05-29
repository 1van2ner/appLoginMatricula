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
            $table->id('id_schedules');
            $table->foreignId('id_course')->constrained('courses', 'id_course')->onDelete('cascade');
            $table->dateTime('weekday');
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->string('num_salon', 10);
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
