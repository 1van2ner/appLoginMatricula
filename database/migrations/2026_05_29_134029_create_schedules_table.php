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
            $table->id(); 
            
            // CAMBIA ESTO: Quitamos el 'unsigned' para que coincida exactamente con el id() de courses
            $table->bigInteger('id_curso'); 
            
            $table->foreign('id_curso')
                  ->references('id_curso')
                  ->on('courses')
                  ->onDelete('cascade');
            
            $table->dateTime('weekday');
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->string('num_salon');
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
