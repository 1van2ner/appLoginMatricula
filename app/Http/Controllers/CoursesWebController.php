<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use Illuminate\Http\Request;

class CoursesWebController extends Controller
{
    public function index() {
    $datos = Course::all(); // O la consulta que necesites
    return view('admin.courses', compact('datos'));
    }

    public function store(StoreCourseRequest $request)
    {
        Course::create($request->validated());

        return redirect()->route('courses.index')->with('status', '¡Curso agregado al catálogo con éxito!');
    }

    public function update(UpdateCourseRequest $request, $id)
    {
        $course = Course::findOrFail($id);
        $course->update($request->validated());

        return redirect()->route('courses.index')->with('status', '¡Curso modificado correctamente!');
    }

    public function create()
    {
        return view('admin.courses-create');
    }

    public function edit($id)
    {
        $course = Course::findOrFail($id);
        return view('admin.courses-edit', compact('course'));
    }

    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();

        return redirect()->route('courses.index')->with('status', '¡Curso eliminado correctamente!');
    }
}