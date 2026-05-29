<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class schedules extends Model
{
    /** @use HasFactory<\Database\Factories\SchedulesFactory> */
    use HasFactory;

    public function curso(){
        return $this-> belogsto(course::class);
    }

    protected $fillable = [
        'weekday',
        'start_time',
        'end_time',
        'num_salon',
    ];
}
