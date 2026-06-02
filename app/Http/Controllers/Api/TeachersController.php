<?php

namespace App\Http\Controllers\Api; // <-- CORRIGE AQUÍ: Agrega "\Api" al final para que coincida con la carpeta real

use App\Models\Profesor;
use Illuminate\Http\Request;

class TeachersController extends Controller // <-- Asegúrate de que se mantenga exactamente así
{
    // ... Todo el resto de tus métodos (index, store, etc.) se quedan exactamente igual
    public function index()
    {
        $profesores = Profesor::all();
        return view('profesores.index', compact('profesores'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'especialidad' => 'required|string|max:255',
        ]);

        Profesor::create($request->all());
        return redirect()->route('profesores.index')->with('success', 'Profesor registrado con éxito.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'especialidad' => 'required|string|max:255',
        ]);

        $profesor = Profesor::findOrFail($id);
        $profesor->update($request->all());

        return redirect()->route('profesores.index')->with('success', 'Profesor actualizado con éxito.');
    }

    public function destroy($id)
    {
        $profesor = Profesor::findOrFail($id);
        $profesor->delete();
        return redirect()->route('profesores.index')->with('success', 'Profesor eliminado correctamente.');
    }
}