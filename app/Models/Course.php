<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // Añadido para que funcione el Factory
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory; // IMPORTANTE: Sin esto, el Seeder no sabrá usar el Factory

    protected $table = 'courses';
    protected $primaryKey = 'id_course';

    protected $fillable = [
        'course_name',
        'course_code',
        'credits',
        'description'
    ];
}