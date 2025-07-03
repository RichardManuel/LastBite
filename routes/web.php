<?php

use Illuminate\Support\Facades\Route;
// Import controller yang benar di bagian atas
use App\Http\Controllers\EateryController; 
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home.index');

// Route untuk halaman utama eatery
Route::get('/eatery', [EateryController::class, 'showPage'])
         ->name('user.eatery');

// Route BARU untuk halaman detail dengan parameter {restaurant}
// Nama 'restaurant' harus sama dengan nama variabel di method controller
Route::get('/eatery/{restaurant}', [EateryController::class, 'showDetail'])
         ->name('eatery.detail');