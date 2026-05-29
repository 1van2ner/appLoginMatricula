<?php

namespace App\Http\Controllers;

use App\Models\Profesor;
use Illuminate\Http\Request;

class ProfesorController extends Controller
{
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