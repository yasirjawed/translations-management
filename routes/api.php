<?php

use App\Http\Controllers\TranslationController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Auth Routes (No Authentication Required)
Route::controller(AuthController::class)->group(function () {
    Route::post('/register', 'register')->name('register');
    Route::post('/login', 'login')->name('login');
});

// Authenticated Routes (Requires Sanctum Token)
Route::middleware('auth:sanctum')->group(function () {
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Translation Routes
    Route::prefix('translations')->controller(TranslationController::class)->group(function () {
        Route::get('/', 'index'); // List translations
        Route::get('/export', 'export'); // Export translations
        Route::post('/', 'store'); // Create a new translation
        Route::put('/{id}', 'update'); // Update a translation
    });
});
