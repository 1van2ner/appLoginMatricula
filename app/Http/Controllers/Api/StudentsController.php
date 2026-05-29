<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student; // Asegúrate de tener tu modelo creado

class StudentsController extends Controller
{
    /**
     * Muestra la lista de todos los alumnos.
     */
    public function index()
    {
        // Traemos todos los alumnos de la base de datos
        $students = Student::all();
        return response()->json($students, 200);
    }

    /**
     * Guarda un nuevo alumno en la base de datos.
     */
    public function store(Request $request)
    {
        // Validamos todos los campos basándonos en tu lista
        $validatedData = $request->validate([
            'nombre'           => 'required|string|max:255',
            'apellidos'        => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date',
            'dni'              => 'required|string|max:20|unique:students,dni', // Evita DNIs duplicados
            'direccion'        => 'nullable|string|max:255',
            'telefono'         => 'nullable|string|max:20',
            'email'            => 'required|email|max:255|unique:students,email', // Evita emails duplicados
            'estado_matricula' => 'required|string|in:matriculado,inactivo', // Solo permite estos valores fijados
        ]);

        // Creamos el registro en la base de datos
        $student = Student::create($validatedData);

        return response()->json([
            'message' => 'Alumno registrado con éxito',
            'data' => $student
        ], 201);
    }

    /**
     * Muestra un alumno en específico según su ID.
     */
    public function show(string $id)
    {
        // Laravel buscará usando la clave primaria de tu modelo
        $student = Student::find($id);

        if (!$student) {
            return response()->json(['message' => 'Alumno no encontrado'], 404);
        }

        return response()->json($student, 200);
    }

    /**
     * Actualiza los datos de un alumno existente.
     */
    public function update(Request $request, string $id)
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json(['message' => 'Alumno no encontrado'], 404);
        }

        // Al actualizar usamos 'sometimes' para que no pida obligatoriamente rellenar todo si solo quieres cambiar un campo
        $validatedData = $request->validate([
            'nombre'           => 'sometimes|string|max:255',
            'apellidos'        => 'sometimes|string|max:255',
            'fecha_nacimiento' => 'sometimes|date',
            'dni'              => 'sometimes|string|max:20|unique:students,dni,' . $id . ',id_alumno', // Ignora el DNI propio al validar
            'direccion'        => 'nullable|string|max:255',
            'telefono'         => 'nullable|string|max:20',
            'email'            => 'sometimes|email|max:255|unique:students,email,' . $id . ',id_alumno', // Ignora el email propio
            'estado_matricula' => 'sometimes|string|in:matriculado,inactivo',
        ]);

        $student->update($validatedData);

        return response()->json([
            'message' => 'Datos del alumno actualizados con éxito',
            'data' => $student
        ], 200);
    }

    /**
     * Elimina un alumno del sistema.
     */
    public function destroy(string $id)
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json(['message' => 'Alumno no encontrado'], 404);
        }

        $student->delete();

        return response()->json(['message' => 'Alumno eliminado correctamente'], 200);
    }
}