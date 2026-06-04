<?php

namespace App\Http\Controllers;

use App\Models\Enrollments;
use App\Models\Students;
use App\Models\Course;
use App\Models\Teacher;
use App\Models\Schedules; // Asegúrate de que la S sea mayúscula si así está tu modelo
use App\Http\Requests\StoreEnrollmentsRequest;
use App\Http\Requests\UpdateEnrollmentsRequest;
use Illuminate\Http\Request;

class EnrollmentsWebController extends Controller
{
    public function index()
    {
        // Pasamos la colección con el nombre que usa la vista
        $enrollments = Enrollments::with(['student', 'course', 'teacher'])->orderBy('id_enrollment', 'desc')->get();
        
        return view('admin.enrollments', compact('enrollments'));
    }

    public function create()
    {
        $students = Students::orderBy('nombre')->get();
        $courses = Course::orderBy('course_name')->get();
        $teachers = Teacher::orderBy('nombre')->get();
        $schedules = Schedules::orderBy('id_schedule')->get();

        return view('admin.enrollments-create', compact('students', 'courses', 'teachers', 'schedules'));
    }

    public function store(StoreEnrollmentsRequest $request)
    {
        Enrollments::create($request->validated());

        return redirect()->route('enrollments.index')->with('status', '¡Matrícula procesada correctamente!');
    }

    public function edit($id)
    {
        $enrollment = Enrollments::findOrFail($id);
        $students = Students::orderBy('nombre')->get();
        $courses = Course::orderBy('course_name')->get();
        $teachers = Teacher::orderBy('nombre')->get();
        $schedules = Schedules::orderBy('id_schedule')->get();

        return view('admin.enrollments-edit', compact('enrollment', 'students', 'courses', 'teachers', 'schedules'));
    }

    public function update(UpdateEnrollmentsRequest $request, $id)
    {
        $enrollment = Enrollments::findOrFail($id);
        $enrollment->update($request->validated());

        return redirect()->route('enrollments.index')->with('status', '¡Registro de matrícula actualizado!');
    }

    public function destroy($id)
    {
        $enrollment = Enrollments::findOrFail($id);
        $enrollment->delete();

        return redirect()->route('enrollments.index')->with('status', '¡Matrícula eliminada correctamente!');
    }
}