<?php

use Illuminate\Support\Facades\Route;


// Route::get('/eatery', function () {
//     return 'Halaman Eatery (Dalam Pengembangan)';
// });

// Route::get('/login-placeholder', function () {
//     return 'Halaman Login (Dalam Pengembangan)';
// });

// Route::get('/register-restaurant-placeholder', function () {
//     return 'Halaman Registrasi Restoran (Dalam Pengembangan)';
// });


// Route::post('/logout-placeholder', function () {
//     return redirect('/')->with('message', 'Anda telah logout (placeholder).');
// })->name('logout.placeholder');

// Route::get('/registeruser', function () {
//     return view('user.register'); 
// }); 

// Route::get('/signinuser', function () {
//     return view('user.signin'); 
// }); 

// Route::get('/forgetpassword', function () {
//     return view('user.forgetpassword'); 
// });

// Route::get('/resetpassword', function () {
//     return view('user.resetpassword'); 
// });




// use App\Http\Controllers\Auth\RegisterController; 

// use App\Http\Controllers\Auth\LoginController; 
// use App\Http\Controllers\RestaurantProfileController;

// Route::get('/signup', [RegisterController::class, 'showRegistrationForm'])->name('register'); 


// Route::post('/signup', [RegisterController::class, 'register']); 


// Route::get('/register/eateryDetails', [RegisterController::class, 'showEateryDetailsForm'])
//     ->name('register.eateryDetails') 
//     ->middleware('auth');


// Route::post('/register/eatery-details/store', [RegisterController::class, 'storeEateryDetails'])
//     ->name('register.eateryDetails.store')
//     ->middleware('auth');



// Route::get('/store/signin', [LoginController::class, 'showLoginForm'])->name('login'); 


// Route::post('/store/signin', [LoginController::class, 'login'])->name('login.submit'); 



// Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


// Route::get('/eatery/profile', [RestaurantProfileController::class, 'show'])
//     ->name('eatery.profile.show')
//     ->middleware(['auth']);




use App\Http\Controllers\Auth\RegisterController; // Untuk signup resto
use App\Http\Controllers\Auth\LoginController;     // Untuk login resto nanti
use App\Http\Controllers\RestaurantProfileController; // Untuk profil resto nanti

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome'); // Halaman utama Anda
});

// --- ALUR PENDAFTARAN RESTO ---
// 1. Menampilkan form signup awal (email, password)
Route::get('/store/signup', [RegisterController::class, 'showRegistrationForm'])->name('resto.signup.form');

// 2. Memproses form signup awal
Route::post('/store/signup', [RegisterController::class, 'processRestoSignup'])->name('resto.signup.submit');

// --- Login & Logout Resto ---
Route::get('/store/signin', [LoginController::class, 'showRestoLoginForm'])->name('resto.login.form');
Route::post('/store/signin', [LoginController::class, 'restoLogin'])->name('resto.login.submit');

// Grup route yang memerlukan login sebagai resto (menggunakan guard 'resto')
Route::middleware('auth:resto')->prefix('store')->name('resto.')->group(function () {
    Route::get('/register-details', [RegisterController::class, 'showEateryDetailsForm'])->name('register.details.form');
    Route::post('/register-details', [RestaurantProfileController::class, 'storeOrUpdateDetails'])->name('register.details.submit'); // Submit ke RestaurantProfileController

    Route::get('/profile', [RestaurantProfileController::class, 'show'])->name('profile.show');
    // Route untuk menampilkan form edit profil restoran
    Route::middleware(['auth:resto'])->group(function () {
        Route::get('/restaurant/profile/edit', [RestaurantProfileController::class, 'edit'])
            ->name('resto.profile.edit');

        Route::put('/restaurant/profile/update', [RestaurantProfileController::class, 'update'])
            ->name('resto.profile.update');
    });

    Route::post('/logout', [LoginController::class, 'restoLogout'])->name('logout');
});


// ROUTE LOGIN DEFAULT LARAVEL (JIKA MIDDLEWARE 'auth' biasa terpanggil)
// Ini bisa mengarah ke login user biasa atau halaman login umum jika ada.
// Untuk sekarang, kita arahkan ke login resto juga, atau buat halaman login umum.
Route::get('/login', [LoginController::class, 'showRestoLoginForm'])->name('login');