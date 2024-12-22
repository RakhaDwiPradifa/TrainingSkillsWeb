<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\ModuleResultController;
use App\Http\Controllers\SesiController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\UserSkillController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PaymentController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Akses untuk User
Route::middleware(['auth:sanctum', 'role:user'])->group(function () {
    // User dapat melihat profil mereka sendiri
    Route::get('user', [UserController::class, 'show']); 
    Route::put('user/{id}', [UserController::class, 'update']); 

    // User dapat melihat kursus
    Route::get('/courses', [CourseController::class, 'index']);
    Route::get('/courses/{id}', [CourseController::class, 'show']);
    
    // User dapat melihat sesi
    Route::get('sesi', [SesiController::class, 'index']);
    
    // User dapat melihat hasil modul mereka
    Route::get('module-results', [ModuleResultController::class, 'index']);

    // User dapat melihat notifikasi mereka
    Route::get('notifications', [NotificationController::class, 'index']);

    // User dapat melihat dan melakukan pembayaran mereka
    Route::get('payments', [PaymentController::class, 'index']);
    Route::get('payments/{id}', [PaymentController::class, 'show']);
});

// Akses untuk Tutor
Route::middleware(['auth:sanctum', 'role:tutor'])->group(function () {
    // Tutor dapat mengelola kursus
    Route::get('/courses', [CourseController::class, 'index']);
    Route::get('/courses/{id}', [CourseController::class, 'show']);
    Route::post('/courses', [CourseController::class, 'store']);
    Route::put('/courses/{id}', [CourseController::class, 'update']);
    Route::delete('/courses/{id}', [CourseController::class, 'destroy']);

    // Tutor dapat mengelola modul
    Route::get('modules', [ModuleController::class, 'index']);
    Route::get('modules/{id}', [ModuleController::class, 'show']);
    Route::post('modules', [ModuleController::class, 'store']);
    Route::put('modules/{id}', [ModuleController::class, 'update']);
    Route::delete('modules/{id}', [ModuleController::class, 'destroy']);

    // Tutor dapat mengelola hasil modul
    Route::get('module-results', [ModuleResultController::class, 'index']);
    Route::post('module-results', [ModuleResultController::class, 'store']);
    Route::get('module-results/{id}', [ModuleResultController::class, 'show']);
    Route::put('module-results/{id}', [ModuleResultController::class, 'update']);
    Route::delete('module-results/{id}', [ModuleResultController::class, 'destroy']);

    // Tutor dapat mengelola ulasan
    Route::get('reviews', [ReviewController::class, 'index']);
    Route::post('reviews', [ReviewController::class, 'store']);
    Route::get('reviews/{id}', [ReviewController::class, 'show']);
    Route::put('reviews/{id}', [ReviewController::class, 'update']);
    Route::delete('reviews/{id}', [ReviewController::class, 'destroy']);
    
    // Tutor dapat melihat notifikasi mereka
    Route::get('notifications', [NotificationController::class, 'index']);
});

// Akses untuk Admin
Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
    // Admin dapat mengelola pengguna
    Route::get('users', [UserController::class, 'index']);
    Route::get('users/{id}', [UserController::class, 'show']);
    Route::post('users', [UserController::class, 'store']);
    Route::put('users/{id}', [UserController::class, 'update']);
    Route::delete('users/{id}', [UserController::class, 'destroy']);
    
    // Admin dapat mengelola kursus
    Route::get('/courses', [CourseController::class, 'index']);
    Route::get('/courses/{id}', [CourseController::class, 'show']);
    Route::post('/courses', [CourseController::class, 'store']);
    Route::put('/courses/{id}', [CourseController::class, 'update']);
    Route::delete('/courses/{id}', [CourseController::class, 'destroy']);

    // Admin dapat mengelola modul
    Route::get('modules', [ModuleController::class, 'index']);
    Route::get('modules/{id}', [ModuleController::class, 'show']);
    Route::post('modules', [ModuleController::class, 'store']);
    Route::put('modules/{id}', [ModuleController::class, 'update']);
    Route::delete('modules/{id}', [ModuleController::class, 'destroy']);

    // Admin dapat mengelola hasil modul
    Route::get('module-results', [ModuleResultController::class, 'index']);
    Route::post('module-results', [ModuleResultController::class, 'store']);
    Route::get('module-results/{id}', [ModuleResultController::class, 'show']);
    Route::put('module-results/{id}', [ModuleResultController::class, 'update']);
    Route::delete('module-results/{id}', [ModuleResultController::class, 'destroy']);

    // Admin dapat mengelola sesi
    Route::get('sesi', [SesiController::class, 'index']);
    Route::get('sesi/{id}', [SesiController::class, 'show']);
    Route::post('sesi', [SesiController::class, 'store']);
    Route::put('sesi/{id}', [SesiController::class, 'update']);
    Route::delete('sesi/{id}', [SesiController::class, 'destroy']);

    // Admin dapat mengelola ulasan
    Route::get('reviews', [ReviewController::class, 'index']);
    Route::post('reviews', [ReviewController::class, 'store']);
    Route::get('reviews/{id}', [ReviewController::class, 'show']);
    Route::put('reviews/{id}', [ReviewController::class, 'update']);
    Route::delete('reviews/{id}', [ReviewController::class, 'destroy']);

    // Admin dapat mengelola pembayaran
    Route::get('payments', [PaymentController::class, 'index']);
    Route::get('payments/{id}', [PaymentController::class, 'show']);
    Route::post('payments', [PaymentController::class, 'store']);
    Route::put('payments/{id}', [PaymentController::class, 'update']);
    Route::delete('payments/{id}', [PaymentController::class, 'destroy']);
    
    // Admin dapat mengelola notifikasi
    Route::get('notifications', [NotificationController::class, 'index']);
    Route::post('notifications', [NotificationController::class, 'store']);
    Route::get('notifications/{id}', [NotificationController::class, 'show']);
    Route::put('notifications/{id}', [NotificationController::class, 'update']);
    Route::delete('notifications/{id}', [NotificationController::class, 'destroy']);
});