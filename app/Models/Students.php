<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    use HasFactory;

    protected $table = 'students';
    protected $primaryKey = 'id_alumno'; // Especificamos tu clave primaria

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