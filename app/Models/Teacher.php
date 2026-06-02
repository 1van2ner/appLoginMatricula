<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    /** @use HasFactory<\Database\Factories\TeacherFactory> */
    use HasFactory;

    // Conexión exacta con tu migración en inglés
    protected $table = 'teachers';
    protected $primaryKey = 'teacher_id';
    public $timestamps = false;

    
    protected $fillable = [
        'first_name', 
        'last_name', 
        'specialty'
    ];
}