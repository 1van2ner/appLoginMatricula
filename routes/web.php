<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StudentsWebController;

// Vista de bienvenida pública
Route::get('/', function () {
    return view('welcome');
});

// Rutas de autenticación (Login, Registro, etc.)
Auth::routes();

// Login con Google
Route::get('/login/google', [App\Http\Controllers\Auth\LoginController::class, 'redirectToGoogle']);
Route::get('/login/google/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleGoogleCallback']);

// Grupo protegido por autenticación para el Panel de Control
Route::middleware(['auth'])->group(function () {
    
    // Ambas URL (/home y /dashboard) ahora llaman al controlador para cargar los alumnos correctamente
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

    // Rutas para los modales de Alumnos (Crear y Editar)
    Route::post('/students', [StudentsWebController::class, 'store'])->name('students.store');
    Route::put('/students/{id}', [StudentsWebController::class, 'update'])->name('students.update');
});