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
        
        Schema::create('enrollments', function (Blueprint $table) {
            
            
            $table->id('id_enrollment');

            
            $table->unsignedBigInteger('id_students');
            $table->unsignedBigInteger('id_course');
            
            
            $table->unsignedBigInteger('id_teacher')->nullable();
            $table->unsignedBigInteger('id_schedule')->nullable();

            
            $table->string('semester', 10);
            $table->date('enrollment_date');
            $table->decimal('final_grade', 4, 2)->nullable(); 
            
            
        
            $table->enum('status', ['approved', 'failed', 'ongoing'])->default('ongoing');

        
            
        
            $table->foreign('id_students')
                ->references('id_students') 
                ->on('students')           
                ->onDelete('cascade'); 

            $table->foreign('id_course')
                ->references('id_course')   
                ->on('courses')            
                ->onDelete('restrict'); 

            $table->foreign('id_teacher')
                ->references('id_teacher')  
                ->on('teachers')           
                ->onDelete('set null'); 

            $table->foreign('id_schedule')
                ->references('id_schedule') 
                ->on('schedules')          
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enrollments');
    }
};