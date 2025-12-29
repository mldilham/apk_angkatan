<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\AngkatanController;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index']);

// ===============================
// 🔐 AUTHENTICATION ROUTES
// ===============================
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ===============================
// 📦 ROUTES UNTUK ADMIN
// ===============================
Route::middleware(['auth', \App\Http\Middleware\CheckAdmin::class])->prefix('admin')->group(function () {
    // ===============================
    // 👤 ANGGOTA MANAGEMENT
    // ===============================
    Route::resource('anggota', AnggotaController::class);

    // ===============================
    // 🖼️ GALERI MANAGEMENT
    // ===============================
    Route::resource('galeri', GaleriController::class);

    // ===============================
    // 📚 ANGKATAN MANAGEMENT
    // ===============================
    Route::resource('angkatan', AngkatanController::class);
});
