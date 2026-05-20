<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KisanController;
use App\Http\Controllers\AuthController;

// Public Landing Page
Route::get('/', [KisanController::class, 'landing'])->name('landing');

// Authentication Routes (Guest Only)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Logout Route (POST request, requires authentication)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Private Dashboard Portal Routes (Requires Authentication)
Route::middleware('auth')->group(function () {
    Route::get('/crops', [KisanController::class, 'crops'])->name('crops');
    Route::get('/calculator', [KisanController::class, 'calculator'])->name('calculator');
    Route::get('/weather', [KisanController::class, 'weather'])->name('weather');
    Route::get('/expert-help', [KisanController::class, 'expertHelp'])->name('expert-help');
    
    Route::post('/advisor/query', [KisanController::class, 'storeQuery'])->name('advisor.query');
});
