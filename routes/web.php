<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\RestaurantProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

// Optional: Redirect /login ke /store/signin supaya tidak membingungkan
// Route::get('/login', fn () => redirect()->route('resto.login.form'));
// Route::get('/login', function () {
//     abort(404); // Atau redirect('/store/signin')
// });


// --- ALUR PENDAFTARAN RESTO ---
Route::get('/store/signup', [RegisterController::class, 'showRegistrationForm'])->name('resto.signup.form');
Route::post('/store/signup', [RegisterController::class, 'processRestoSignup'])->name('resto.signup.submit');

// --- LOGIN & LOGOUT RESTO ---
Route::get('/store/signin', [LoginController::class, 'showRestoLoginForm'])->name('resto.login.form');
Route::post('/store/signin', [LoginController::class, 'restoLogin'])->name('resto.login.submit');
Route::post('/store/logout', [LoginController::class, 'restoLogout'])->name('resto.logout');

// --- RUTE YANG MEMBUTUHKAN LOGIN GUARD 'resto' ---
Route::middleware('auth:resto')->prefix('store')->name('resto.')->group(function () {
    
    // Detail restoran (lanjutan pendaftaran)
    Route::get('/register-details', [RegisterController::class, 'showEateryDetailsForm'])->name('register.details.form');
    Route::post('/register-details', [RestaurantProfileController::class, 'storeOrUpdateDetails'])->name('register.details.submit');

    // Profil restoran
    Route::get('/profile', [RestaurantProfileController::class, 'show'])->name('profile.show');
    Route::get('/restaurant/profile/edit', [RestaurantProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/restaurant/profile/update', [RestaurantProfileController::class, 'update'])->name('profile.update');

    // Logout
    // Route::post('/logout', [LoginController::class, 'restoLogout'])->name('logout');
});
