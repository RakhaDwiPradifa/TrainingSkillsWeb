<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\EnrollmentController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('users', [UserController::class, 'index']);
Route::get('users/{id}', [UserController::class, 'show']);
Route::post('users', [UserController::class, 'store']);
Route::put('users/{id}', [UserController::class, 'update']);
Route::delete('users/{id}', [UserController::class, 'destroy']);

Route::get('/courses', [CourseController::class, 'index']); // Menampilkan semua kursus
Route::get('/courses/{id}', [CourseController::class, 'show']); // Menampilkan kursus berdasarkan ID
Route::post('/courses', [CourseController::class, 'store']); // Menyimpan kursus baru
Route::put('/courses/{id}', [CourseController::class, 'update']); // Mengupdate kursus
Route::delete('/courses/{id}', [CourseController::class, 'destroy']); // Menghapus kursus

// Routes API untuk Modules
Route::get('modules', [ModuleController::class, 'index']);
Route::get('modules/{id}', [ModuleController::class, 'show']);
Route::post('modules', [ModuleController::class, 'store']);
Route::put('modules/{id}', [ModuleController::class, 'update']);
Route::delete('modules/{id}', [ModuleController::class, 'destroy']);

Route::get('enrollments', [EnrollmentController::class, 'index']);
Route::get('enrollments/{id}', [EnrollmentController::class, 'show']);
Route::post('enrollments', [EnrollmentController::class, 'store']);
Route::put('enrollments/{id}', [EnrollmentController::class, 'update']);
Route::delete('enrollments/{id}', [EnrollmentController::class, 'destroy']);