<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StudentsWebController;
use App\Http\Controllers\Auth\SocialController;
use App\Http\Controllers\TeachersWebController;
use App\Http\Controllers\CoursesWebController;
use App\Http\Controllers\EnrollmentsWebController;
use App\Http\Controllers\SchedulesWebController;

// 1. VISTA DE BIENVENIDA PÚBLICA
Route::get('/', function () {
    return view('welcome');
});

// 2. RUTAS DE AUTENTICACIÓN TRADICIONAL
Auth::routes();

// 3. LOGIN CON SOCIALITE
Route::get('/login/google', [App\Http\Controllers\Auth\LoginController::class, 'redirectToGoogle']);
Route::get('/login/google/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleGoogleCallback']);

Route::get('/login/github', [SocialController::class, 'redirectToGithub']);
Route::get('/login/github/callback', [SocialController::class, 'handleGithubCallback']);

// 4. GRUPO PROTEGIDO POR AUTENTICACIÓN
Route::middleware(['auth'])->group(function () {

    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

    // MÓDULO DE ALUMNOS
    Route::get('/admin/students', [StudentsWebController::class, 'index'])->name('students.index');
    Route::post('/admin/students', [StudentsWebController::class, 'store'])->name('students.store');
    Route::put('/admin/students/{id}', [StudentsWebController::class, 'update'])->name('students.update');
    Route::delete('/admin/students/{id}', [StudentsWebController::class, 'destroy'])->name('students.destroy');

    // MÓDULO DE CURSOS
    Route::get('/admin/courses', [CoursesWebController::class, 'index'])->name('courses.index');
    Route::get('/admin/courses/create', [CoursesWebController::class, 'create'])->name('courses.create');
    Route::post('/admin/courses', [CoursesWebController::class, 'store'])->name('courses.store');
    Route::get('/admin/courses/{id}/edit', [CoursesWebController::class, 'edit'])->name('courses.edit');
    Route::put('/admin/courses/{id}', [CoursesWebController::class, 'update'])->name('courses.update');
    Route::delete('/admin/courses/{id}', [CoursesWebController::class, 'destroy'])->name('courses.destroy');

    // MÓDULO DE MATRÍCULAS (ENROLLMENTS)
    Route::get('/admin/enrollments', [EnrollmentsWebController::class, 'index'])->name('enrollments.index');
    Route::get('/admin/enrollments/create', [EnrollmentsWebController::class, 'create'])->name('enrollments.create');
    Route::post('/admin/enrollments', [EnrollmentsWebController::class, 'store'])->name('enrollments.store');
    Route::get('/admin/enrollments/{id}/edit', [EnrollmentsWebController::class, 'edit'])->name('enrollments.edit');
    Route::put('/admin/enrollments/{id}', [EnrollmentsWebController::class, 'update'])->name('enrollments.update');
    Route::delete('/admin/enrollments/{id}', [EnrollmentsWebController::class, 'destroy'])->name('enrollments.destroy');

    // MÓDULO DE HORARIOS
    Route::get('/admin/schedules', [SchedulesWebController::class, 'index'])->name('schedules.index');

    // MÓDULO DE PROFESORES
    Route::get('/admin/teachers', [TeachersWebController::class, 'index'])->name('teachers.index');
    Route::post('/admin/teachers', [TeachersWebController::class, 'store'])->name('teachers.store');
    Route::put('/admin/teachers/{id}', [TeachersWebController::class, 'update'])->name('teachers.update');
    Route::delete('/admin/teachers/{id}', [TeachersWebController::class, 'destroy'])->name('teachers.destroy');
});