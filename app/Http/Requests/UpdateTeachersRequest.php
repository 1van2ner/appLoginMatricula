<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest; // Se mantiene la importación original

class UpdateTeachersRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // <-- CORRECCIÓN: Cambiado de false a true para que Laravel permita editar
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // Aquí validamos los 3 campos editables del profesor
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'especialidad' => 'required|string|max:255',
        ];
    }
}