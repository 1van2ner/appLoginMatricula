<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;

class TeachersWebController extends Controller
{
    public function index()
    {
        // Traemos todos los profesores ordenados por su ID descendente
        $teachers = Teacher::orderBy('id_profesor', 'desc')->get();
        return view('admin.teachers', compact('teachers'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre'       => 'required|string|max:100',
            'apellidos'    => 'required|string|max:100',
            'dni'          => 'required|string|max:8|unique:teachers,dni',
            'email'        => 'required|email|max:150|unique:teachers,email',
            'telefono'     => 'nullable|string|max:20',
            'especialidad' => 'nullable|string|max:100',
            'estado'       => 'required|in:activo,inactivo'
        ]);

        Teacher::create($validatedData);

        return redirect()->route('teachers.index')->with('status', '¡Profesor registrado exitosamente!');
    }

    public function update(Request $request, $id)
    {
        $teacher = Teacher::where('id_profesor', $id)->firstOrFail();

        $validatedData = $request->validate([
            'nombre'       => 'required|string|max:100',
            'apellidos'    => 'required|string|max:100',
            'dni'          => 'required|string|max:8|unique:teachers,dni,' . $id . ',id_profesor',
            'email'        => 'required|email|max:150|unique:teachers,email,' . $id . ',id_profesor',
            'telefono'     => 'nullable|string|max:20',
            'especialidad' => 'nullable|string|max:100',
            'estado'       => 'required|in:activo,inactivo'
        ]);

        $teacher->update($validatedData);

        return redirect()->route('teachers.index')->with('status', '¡Datos del profesor actualizados correctamente!');
    }

    public function destroy($id)
    {
        $teacher = Teacher::where('id_profesor', $id)->firstOrFail();
        $teacher->delete();

        return redirect()->route('teachers.index')->with('status', 'Profesor eliminado correctamente del sistema.');
    }
}