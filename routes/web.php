<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/login/google', [App\Http\Controllers\Auth\LoginController::class, 'redirectToGoogle']);

Route::get('/login/google/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleGoogleCallback']);

Route::middleware(['auth'])->get('/dashboard', function(){
    return view('home');
});