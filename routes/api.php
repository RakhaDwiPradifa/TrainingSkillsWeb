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
use App\Http\Middleware\CorsMiddleware;
use App\Http\Controllers\AuthController;

// Middleware untuk mengatur CORS
Route::middleware([CorsMiddleware::class])->group(function () {
    Route::get('/cors', function () {
        return response()->json(['message' => 'CORS berhasil diatur!']);
    });
});

// Route untuk Register
Route::middleware('api')->post('/register', [AuthController::class, 'register']);

// Route untuk Login
Route::middleware('api')->post('/login', [AuthController::class, 'login']);

// Routes untuk API Auth
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Akses untuk User
Route::middleware(['auth:sanctum', 'role:user'])->group(function () {
    Route::get('user', [UserController::class, 'show']); 
    Route::put('user/{id}', [UserController::class, 'update']); 
    Route::get('/courses', [CourseController::class, 'index']);
    Route::get('/courses/{id}', [CourseController::class, 'show']);
    Route::get('sesi', [SesiController::class, 'index']);
    Route::get('module-results', [ModuleResultController::class, 'index']);
    Route::get('notifications', [NotificationController::class, 'index']);
    Route::get('payments', [PaymentController::class, 'index']);
    Route::get('payments/{id}', [PaymentController::class, 'show']);
});

// Akses untuk Tutor
Route::middleware(['auth:sanctum', 'role:tutor'])->group(function () {
    Route::get('/courses', [CourseController::class, 'index']);
    Route::get('/courses/{id}', [CourseController::class, 'show']);
    Route::post('/courses', [CourseController::class, 'store']);
    Route::put('/courses/{id}', [CourseController::class, 'update']);
    Route::delete('/courses/{id}', [CourseController::class, 'destroy']);
    Route::get('modules', [ModuleController::class, 'index']);
    Route::get('modules/{id}', [ModuleController::class, 'show']);
    Route::post('modules', [ModuleController::class, 'store']);
    Route::put('modules/{id}', [ModuleController::class, 'update']);
    Route::delete('modules/{id}', [ModuleController::class, 'destroy']);
    Route::get('module-results', [ModuleResultController::class, 'index']);
    Route::post('module-results', [ModuleResultController::class, 'store']);
    Route::get('module-results/{id}', [ModuleResultController::class, 'show']);
    Route::put('module-results/{id}', [ModuleResultController::class, 'update']);
    Route::delete('module-results/{id}', [ModuleResultController::class, 'destroy']);
    Route::get('reviews', [ReviewController::class, 'index']);
    Route::post('reviews', [ReviewController::class, 'store']);
    Route::get('reviews/{id}', [ReviewController::class, 'show']);
    Route::put('reviews/{id}', [ReviewController::class, 'update']);
    Route::delete('reviews/{id}', [ReviewController::class, 'destroy']);
    Route::get('notifications', [NotificationController::class, 'index']);
});

// Akses untuk Admin
Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
    Route::get('users', [UserController::class, 'index']);
    Route::get('users/{id}', [UserController::class, 'show']);
    Route::post('users', [UserController::class, 'store']);
    Route::put('users/{id}', [UserController::class, 'update']);
    Route::delete('users/{id}', [UserController::class, 'destroy']);
    Route::get('/courses', [CourseController::class, 'index']);
    Route::get('/courses/{id}', [CourseController::class, 'show']);
    Route::post('/courses', [CourseController::class, 'store']);
    Route::put('/courses/{id}', [CourseController::class, 'update']);
    Route::delete('/courses/{id}', [CourseController::class, 'destroy']);
    Route::get('modules', [ModuleController::class, 'index']);
    Route::get('modules/{id}', [ModuleController::class, 'show']);
    Route::post('modules', [ModuleController::class, 'store']);
    Route::put('modules/{id}', [ModuleController::class, 'update']);
    Route::delete('modules/{id}', [ModuleController::class, 'destroy']);
    Route::get('module-results', [ModuleResultController::class, 'index']);
    Route::post('module-results', [ModuleResultController::class, 'store']);
    Route::get('module-results/{id}', [ModuleResultController::class, 'show']);
    Route::put('module-results/{id}', [ModuleResultController::class, 'update']);
    Route::delete('module-results/{id}', [ModuleResultController::class, 'destroy']);
    Route::get('sesi', [SesiController::class, 'index']);
    Route::get('sesi/{id}', [SesiController::class, 'show']);
    Route::post('sesi', [SesiController::class, 'store']);
    Route::put('sesi/{id}', [SesiController::class, 'update']);
    Route::delete('sesi/{id}', [SesiController::class, 'destroy']);
    Route::get('reviews', [ReviewController::class, 'index']);
    Route::post('reviews', [ReviewController::class, 'store']);
    Route::get('reviews/{id}', [ReviewController::class, 'show']);
    Route::put('reviews/{id}', [ReviewController::class, 'update']);
    Route::delete('reviews/{id}', [ReviewController::class, 'destroy']);
    Route::get('payments', [PaymentController::class, 'index']);
    Route::get('payments/{id}', [PaymentController::class, 'show']);
    Route::post('payments', [PaymentController::class, 'store']);
    Route::put('payments/{id}', [PaymentController::class, 'update']);
    Route::delete('payments/{id}', [PaymentController::class, 'destroy']);
    Route::get('notifications', [NotificationController::class, 'index']);
    Route::post('notifications', [NotificationController::class, 'store']);
    Route::get('notifications/{id}', [NotificationController::class, 'show']);
    Route::put('notifications/{id}', [NotificationController::class, 'update']);
    Route::delete('notifications/{id}', [NotificationController::class, 'destroy']);
});
