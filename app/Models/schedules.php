<?php

namespace App\Models;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class schedules extends Model
{
    /** @use HasFactory<\Database\Factories\SchedulesFactory> */
    use HasFactory;

    protected $table = 'schedules';
    protected $primaryKey = 'id_schedule';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'id_course',
        'weekday',
        'start_time',
        'end_time',
        'num_salon',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class, 'id_course', 'id_course');
    }
}
