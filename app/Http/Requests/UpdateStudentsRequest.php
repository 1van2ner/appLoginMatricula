<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentsRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $studentId = $this->route('student');
    
        return [
            'nombre'           => 'sometimes|string|max:255',
            'apellidos'        => 'sometimes|string|max:255',
            'fecha_nacimiento' => 'sometimes|date',
            'dni'              => 'sometimes|string|max:20|unique:students,dni,' . $studentId . ',id_alumno',
            'direccion'        => 'nullable|string|max:255',
            'telefono'         => 'nullable|string|max:20',
            'email'            => 'sometimes|email|max:255|unique:students,email,' . $studentId . ',id_alumno',
            
            'estado_matricula' => 'sometimes|string|in:matriculado,inactivo',
        ];
    }
}