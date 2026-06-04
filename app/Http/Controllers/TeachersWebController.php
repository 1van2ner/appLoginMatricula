<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
class TeachersWebController extends Controller
{
    public function index()
    {
        $teachers = Teacher::orderBy('id_profesor', 'desc')->get();
        return view('admin.teachers', compact('teachers'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre'       => 'required|string|max:100',
            'apellidos'    => 'required|string|max:100',
            'especialidad' => 'nullable|string|max:100',
        ]);

        try {
            // Create only allowed attributes
            Teacher::create([
                'nombre' => $validatedData['nombre'],
                'apellidos' => $validatedData['apellidos'],
                'especialidad' => $validatedData['especialidad'] ?? null,
            ]);
        } catch (\Exception $e) {
            \Log::error('Error al crear profesor: ' . $e->getMessage(), ['data' => $validatedData]);
            return redirect()->back()->withInput()->with('error', 'No se pudo guardar el profesor. Revisa el log.');
        }

        return redirect()->route('teachers.index')->with('status', '¡Profesor registrado exitosamente!');
    }

    public function update(Request $request, $id)
    {
        $teacher = Teacher::where('id_profesor', $id)->firstOrFail();

        $validatedData = $request->validate([
            'nombre'       => 'required|string|max:100',
            'apellidos'    => 'required|string|max:100',
            'especialidad' => 'nullable|string|max:100',
        ]);

        try {
            $teacher->update([
                'nombre' => $validatedData['nombre'],
                'apellidos' => $validatedData['apellidos'],
                'especialidad' => $validatedData['especialidad'] ?? null,
            ]);
        } catch (\Exception $e) {
            \Log::error('Error al actualizar profesor: ' . $e->getMessage(), ['id' => $id, 'data' => $validatedData]);
            return redirect()->back()->withInput()->with('error', 'No se pudo actualizar el profesor. Revisa el log.');
        }

        return redirect()->route('teachers.index')->with('status', '¡Datos del profesor actualizados correctamente!');
    }

    public function destroy($id)
    {
        $teacher = Teacher::where('id_profesor', $id)->firstOrFail();
        $teacher->delete();

        return redirect()->route('teachers.index')->with('status', 'Profesor eliminado correctamente del sistema.');
    }
}