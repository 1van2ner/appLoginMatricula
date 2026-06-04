<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class schedulesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id_course'     => $this -> id_course,
            'weekday'       => $this -> weekday,
            'start_time'    => $this -> start_time,
            'end_time'      => $this -> end_time,
            'num_salon'     => $this -> num_salon,
        ];
    }
}
