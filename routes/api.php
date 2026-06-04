<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StudentsController;
use App\Http\Controllers\Api\TeachersController;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\schedulesController;
use App\Http\Controllers\Api\EnrollmentsController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth.basic')->get('/user', function(Request $request){
    return $request->user();
});

Route::apiResource('students', StudentsController::class);
Route::apiResource('teachers', TeachersController::class);
Route::apiResource('courses', CourseController::class);
Route::apiResource('Schedules', schedulesController::class);
Route::apiResource('enrollemnts', EnrollmentsController::class);