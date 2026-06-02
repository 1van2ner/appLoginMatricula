<?php

namespace App\Http\Controllers\Api; // <-- Namespace correcto que ya tenías

use App\Http\Controllers\Controller;
use App\Models\Teacher; // <-- Cambiado a 'Teacher' para usar tu modelo corregido en inglés
use Illuminate\Http\Request;

class TeachersController extends Controller
{
    public function index()
    {
        // Trae los datos usando tu modelo en inglés
        $profesores = Teacher::all();
        return view('profesores.index', compact('profesores'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_profesor' => 'required|integer', // Tu clave primaria personalizada
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'especialidad' => 'required|string|max:255',
        ]);

        Teacher::create($request->all());
        return redirect()->route('profesores.index')->with('success', 'Profesor registrado con éxito.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'especialidad' => 'required|string|max:255',
        ]);

        // Busca usando tu modelo en inglés
        $profesor = Teacher::findOrFail($id);
        $profesor->update($request->all());

        return redirect()->route('profesores.index')->with('success', 'Profesor actualizado con éxito.');
    }

    public function destroy($id)
    {
        // Busca y elimina usando tu modelo en inglés
        $profesor = Teacher::findOrFail($id);
        $profesor->delete();
        
        return redirect()->route('profesores.index')->with('success', 'Profesor eliminado correctamente.');
    }
}