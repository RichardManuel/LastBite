<?php

use App\Models\Store;
use App\Models\Pickup;
use App\Models\Customer;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\RestaurantProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Landing Page
Route::get('/', function () {
    return view('welcome');
});

// Optional: Redirect /login ke /store/signin supaya tidak membingungkan
// Route::get('/login', fn () => redirect()->route('resto.login.form'));
// Route::get('/login', function () {
//     abort(404); // Atau redirect('/store/signin')
// });

/*
|--------------------------------------------------------------------------
| RESTAURANT AUTH & PROFILE ROUTES
|--------------------------------------------------------------------------
*/

// Alur Pendaftaran Restoran
Route::get('/store/signup', [RegisterController::class, 'showRegistrationForm'])->name('resto.signup.form');
Route::post('/store/signup', [RegisterController::class, 'processRestoSignup'])->name('resto.signup.submit');

// Login & Logout Restoran
Route::get('/store/signin', [LoginController::class, 'showRestoLoginForm'])->name('resto.login.form');
Route::post('/store/signin', [LoginController::class, 'restoLogin'])->name('resto.login.submit');
Route::post('/store/logout', [LoginController::class, 'restoLogout'])->name('resto.logout');

// Rute yang Memerlukan Login Guard 'resto'
Route::middleware('auth:resto')->prefix('store')->name('resto.')->group(function () {

    // Lanjutan Pendaftaran: Detail Restoran
    Route::get('/register-details', [RegisterController::class, 'showEateryDetailsForm'])->name('register.details.form');
    Route::post('/register-details', [RestaurantProfileController::class, 'storeOrUpdateDetails'])->name('register.details.submit');

    // Profil Restoran
    Route::get('/profile', [RestaurantProfileController::class, 'show'])->name('profile.show');
    Route::get('/restaurant/profile/edit', [RestaurantProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/restaurant/profile/update', [RestaurantProfileController::class, 'update'])->name('profile.update');
});


/*
|--------------------------------------------------------------------------
| CHECKOUT ROUTES (STRIPE)
|--------------------------------------------------------------------------
*/

// Tampilkan Halaman Reserved Checkout
Route::get('/checkout/reserved', function () {
    $customer = Customer::first();
    $store = Store::first();
    $pickup = Pickup::first();

    return view('checkout.reserved', compact('customer', 'store', 'pickup'));
})->name('checkout.reserved');

// Proses Data Reserved
Route::post('/checkout/reserved', [StripeController::class, 'processReservedInfo'])->name('checkout.processReservedInfo');

// Review Pembayaran
Route::get('/checkout/review', [StripeController::class, 'review'])->name('checkout.review');

// Checkout ke Stripe
Route::post('/checkout/stripe', [StripeController::class, 'checkout'])->name('checkout.stripe');

// Halaman Sukses Pembayaran
Route::get('/checkout/success', [StripeController::class, 'success'])->name('checkout.success');
