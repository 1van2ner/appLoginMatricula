<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEnrollmentsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; 
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id_alumno'        => 'required|exists:students,id_alumno',
            'id_course'        => 'required|exists:courses,id_course',
            'id_teacher'       => 'nullable|exists:teachers,id_profesor',
            'id_schedule'      => 'nullable|exists:schedules,id_schedule',
            'semester'         => 'required|string|max:10',
            'enrollment_date'  => 'required|date',
            'final_grade'      => 'nullable|numeric|between:0,20',
            'status'           => 'required|in:approved,failed,ongoing'
        ];
    }

    /**
     * 
     */
    public function messages(): array
    {
        return [
            'student_id.required'  => 'El alumno es obligatorio.',
            'student_id.exists'    => 'El alumno seleccionado no existe en el sistema.',
            'course_id.required'   => 'El curso es obligatorio.',
            'course_id.exists'     => 'El curso seleccionado no existe.',
            'status.required'      => 'El estado es obligatorio.',
            'status.in'            => 'El estado debe ser: aprobado, reprobado o cursando.',
            'final_grade.between'  => 'La nota final debe estar en el rango de 0 a 20.',
            'enrollment_date.date' => 'La fecha de matrícula debe ser una fecha válida.'
        ];
    }
}