<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollments extends Model
{
    /** @use HasFactory<\Database\Factories\EnrollmentsFactory> */
    use HasFactory;

    // 1. Nombre real de la tabla en la base de datos (Inglés y plural)
    protected $table = 'enrollments'; 

    
    protected $primaryKey = 'enrollments_id';

    
    public $timestamps = false;

    
    protected $fillable = [
        'student_id',
        'course_id',
        'teacher_id',
        'schedule_id',
        'semester',
        'enrollment_date',
        'final_grade',
        'status'
    ];

    /**
     * ==========================================
     * RELACIONES (Muchos a Uno / BelongsTo)
     * ==========================================
     */

    /**
     * Relación con el Alumno (Student)
     */
    public function student()
    {
        // Nota: Cambia 'Students::class' por el nombre real de tu modelo de Alumnos
        // El segundo parámetro es la FK de esta tabla, el tercero es la PK de la tabla Alumnos
        return $this->belongsTo(Students::class, 'student_id', 'student_id');
    }

    /**
     * Relación con el Curso (Course)
     */
    public function course()
    {
        return $this->belongsTo(Courses::class, 'course_id', 'course_id');
    }

    /**
     * Relación con el Profesor (Teacher) - Opcional
     */
    public function teacher()
    {
        return $this->belongsTo(Teachers::class, 'teacher_id', 'teacher_id');
    }

    /**
     * Relación con el Horario (Schedule) - Opcional
     */
    public function schedule()
    {
        return $this->belongsTo(Schedules::class, 'schedule_id', 'schedule_id');
    }
}