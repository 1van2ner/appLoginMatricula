<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Students;
use App\Models\Course;
use App\Models\Teacher;
use App\Models\schedules;

class Enrollments extends Model
{
    /** @use HasFactory<\Database\Factories\EnrollmentsFactory> */
    use HasFactory;

    // 1. Nombre real de la tabla en la base de datos (Inglés y plural)
protected $table = 'enrollments';
    protected $primaryKey = 'id_enrollment';
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
        return $this->belongsTo(Students::class, 'id_alumno', 'id_alumno');
    }

    /**
     * Relación con el Curso (Course)
     */
    public function course()
    {
        return $this->belongsTo(Course::class, 'id_course', 'id_course');
    }

    /**
     * Relación con el Profesor (Teacher) - Opcional
     */
    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'id_teacher', 'id_profesor');
    }

    /**
     * Relación con el Horario (Schedule) - Opcional
     */
    public function schedule()
    {
        return $this->belongsTo(schedules::class, 'id_schedule', 'id_schedule');
    }
}