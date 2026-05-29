<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCourseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Cambiado a true para evitar el Error 403
    }

    public function rules(): array
    {
        return [
            'course_name' => 'required|string|max:150',
            'course_code' => 'required|string|max:20|unique:courses,course_code',
            'credits'     => 'required|integer|min:1',
            'description' => 'nullable|string'
        ];
    }
}