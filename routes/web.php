<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\store\AuthController;
use App\Http\Controllers\store\StockController;
use App\Http\Controllers\user\RegisterController;
use App\Http\Controllers\user\LoginController;
use App\Http\Controllers\user\ForgotPasswordController;
use App\Http\Controllers\user\ResetPasswordController;
use App\Http\Controllers\user\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

// Guest-only user routes
Route::get('/register', [RegisterController::class, 'showForm'])->name('register.form');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

// ============================
// 👤 USER ROUTES
// ============================
Route::prefix('user')->group(function () {
    // Authenticated user-only routes
    Route::middleware(['auth', 'role:user'])->group(function () {
        Route::get('/profile', [ProfileController::class, 'showProfile'])->name('profile.show');
        Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    });
});


// ============================
// 🛒 STORE ROUTES
// ============================
Route::prefix('store')->group(function () {
    Route::middleware(['auth', 'role:store'])->group(function () {
        Route::get('/stocks', [StockController::class, 'index'])->name('stocks.index');
        Route::post('/stocks/update', [StockController::class, 'update'])->name('stocks.update');
    });
});


// ============================
// 🔐 ADMIN ROUTES (example)
// ============================

Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', function () {
        return 'Admin Dashboard';
    })->name('admin.dashboard');
});
