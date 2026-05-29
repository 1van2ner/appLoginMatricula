<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id_course,
            'name' => $this->course_name,
            'code' => $this->course_code,
            'credits' => $this->credits,
            'description' => $this->description ?? 'No description provided.',
        ];
    }
}