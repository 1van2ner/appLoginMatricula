<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Students; // Importamos tu modelo en plural

class StudentsWebController extends Controller
{
    /**
     * Recibe los datos del modal y registra un nuevo alumno.
     */
    public function store(Request $request)
    {
        // Validamos todos los campos del diseño proporcionado
        $validatedData = $request->validate([
            'nombre'           => 'required|string|max:255',
            'apellidos'        => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date',
            'dni'              => 'required|string|max:20|unique:students,dni',
            'direccion'        => 'nullable|string|max:255',
            'telefono'         => 'nullable|string|max:20',
            'email'            => 'required|email|max:255|unique:students,email',
            'estado_matricula' => 'required|string|in:matriculado,inactivo',
        ]);

        // Crea el registro en la base de datos usando Eloquent
        Students::create($validatedData);

        // Redirecciona de vuelta con un mensaje de éxito para Blade
        return redirect()->route('home')->with('status', '¡Alumno registrado exitosamente!');
    }

    /**
     * Recibe los datos del modal de edición y actualiza al alumno.
     */
    public function update(Request $request, string $id)
    {
        // Buscamos al alumno por su clave primaria id_alumno
        $student = Students::findOrFail($id);

        // Validamos ignorando el DNI y Email del alumno actual para que no choque el campo 'unique'
        $validatedData = $request->validate([
            'nombre'           => 'required|string|max:255',
            'apellidos'        => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date',
            'dni'              => 'required|string|max:20|unique:students,dni,' . $id . ',id_alumno',
            'direccion'        => 'nullable|string|max:255',
            'telefono'         => 'nullable|string|max:20',
            'email'            => 'required|email|max:255|unique:students,email,' . $id . ',id_alumno',
            'estado_matricula' => 'required|string|in:matriculado,inactivo',
        ]);

        // Guardamos los cambios
        $student->update($validatedData);

        return redirect()->route('home')->with('status', '¡Datos del alumno actualizados correctamente!');
    }
}