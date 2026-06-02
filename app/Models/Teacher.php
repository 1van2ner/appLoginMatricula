<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $table = 'teachers'; 
    protected $primaryKey = 'id_profesor'; 
    protected $fillable = ['id_profesor', 'nombre', 'apellidos', 'especialidad'];
    public $timestamps = false; 
}