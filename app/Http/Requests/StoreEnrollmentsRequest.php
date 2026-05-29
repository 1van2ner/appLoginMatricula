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
            'student_id'       => 'required|exists:alumnos,id_alumno', 
            'course_id'        => 'required|exists:cursos,id_curso',
            'teacher_id'       => 'nullable|exists:profesores,id_profesor', 
            'schedule_id'      => 'nullable|exists:horarios,id_horario',   
            'semester'         => 'required|string|max:10',
            'enrollment_date'  => 'required|date',
            'final_grade'      => 'nullable|numeric|between:0,20', 
            'status'           => 'required|in:aprobado,reprobado,cursando' 
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