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
            
            
            $table->id('enrollment_id');

            
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('course_id');
            
            
            $table->unsignedBigInteger('teacher_id')->nullable();
            $table->unsignedBigInteger('schedule_id')->nullable();

            
            $table->string('semester', 10);
            $table->date('enrollment_date');
            $table->decimal('final_grade', 4, 2)->nullable(); 
            
            
        
            $table->enum('status', ['approved', 'failed', 'ongoing'])->default('ongoing');

        
            
        
            $table->foreign('student_id')
                  ->references('student_id') 
                  ->on('students')           
                  ->onDelete('cascade'); 

            $table->foreign('course_id')
                  ->references('course_id')   
                  ->on('courses')            
                  ->onDelete('restrict'); 

            $table->foreign('teacher_id')
                  ->references('teacher_id')  
                  ->on('teachers')           
                  ->onDelete('set null'); 

            $table->foreign('schedule_id')
                  ->references('schedule_id') 
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