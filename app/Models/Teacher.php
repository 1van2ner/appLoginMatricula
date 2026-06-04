<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $table = 'teachers';
    protected $primaryKey = 'id_teacher'; // Indicamos la llave primaria propia
    public $timestamps = false;

    protected $fillable = [
        'first_name',
        'last_name',
        'specialty',
    ];
}