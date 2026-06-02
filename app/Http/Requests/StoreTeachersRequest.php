<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest; // <-- Se mantiene igual que en tu captura

class StoreTeachersRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // <-- CORRECCIÓN: Cambiado de false a true para permitir el registro
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // Reemplazamos los comentarios // por tus 4 campos reales:
            'id_profesor' => 'required|integer',
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'especialidad' => 'required|string|max:255',
        ];
    }
}