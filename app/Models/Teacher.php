<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $table = 'teachers';
    protected $primaryKey = 'id_profesor'; // Indicamos la llave primaria propia
    // Solo los atributos necesarios: nombre, apellidos, especialidad
    protected $fillable = [
        'nombre',
        'apellidos',
        'especialidad',
    ];
}