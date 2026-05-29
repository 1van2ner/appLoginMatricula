<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    /** @use HasFactory<\Database\Factories\StudentsFactory> */
    use HasFactory;

    // ¡AÑADE ESTO JUSTO AQUÍ!
    protected $table = 'students'; // Nombre exacto de tu tabla en la base de datos
    protected $primaryKey = 'id_alumno'; // Tu clave primaria personalizada

    protected $fillable = [
        'nombre',
        'apellidos',
        'fecha_nacimiento',
        'dni',
        'direccion',
        'telefono',
        'email',
        'estado_matricula'
    ];
}

