<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEnrollmentsRequest extends FormRequest
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
            'id_alumno'        => 'sometimes|required|exists:students,id_alumno',
            'id_course'        => 'sometimes|required|exists:courses,id_course',
            'id_teacher'       => 'sometimes|nullable|exists:teachers,id_profesor',
            'id_schedule'      => 'sometimes|nullable|exists:schedules,id_schedule',
            'semester'         => 'sometimes|string|max:10',
            'enrollment_date'  => 'sometimes|date',
            'final_grade'      => 'sometimes|nullable|numeric|between:0,20',
            'status'           => 'sometimes|in:approved,failed,ongoing'
        ];
    }

    /**
     * Personalización de mensajes para mantener el estándar en español.
     */
    public function messages(): array
    {
        return [
            'teacher_id.exists'    => 'El profesor asignado no existe.',
            'schedule_id.exists'   => 'El horario asignado no es válido.',
            'final_grade.between'  => 'La nota final debe estar en el rango de 0 a 20.',
            'status.in'            => 'El estado debe ser: aprobado, reprobado o cursando.',
            'enrollment_date.date' => 'La fecha de matrícula debe ser una fecha válida.'
        ];
    }
}