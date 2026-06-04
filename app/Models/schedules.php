<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class schedules extends Model
{
    /** @use HasFactory<\Database\Factories\SchedulesFactory> */
    use HasFactory;

    protected $table = 'schedules';
    protected $primaryKey = 'id_schedule'; // Indicamos la llave primaria propia
    public $timestamps = false;

    public function curso(){
        return $this-> hasMany(course::class);
    }

    protected $fillable = [
        'id_course',
        'weekday',
        'start_time',
        'end_time',
        'num_salon',
    ];
}
