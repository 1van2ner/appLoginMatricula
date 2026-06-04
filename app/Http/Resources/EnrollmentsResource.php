<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EnrollmentsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id_alumno'         => $this -> id_alumno,
            'id_course'         => $this -> id_course,
            'id_teacher'        => $this -> id_teacher,
            'id_schedule'       => $this -> id_schedule,
            'semester'          => $this -> semester,
            'enrollment_date'   => $this -> enrollment_date,
            'final_grade'       => $this -> final_grade,
            'status'            => $this -> status,
        ];
    }
}
