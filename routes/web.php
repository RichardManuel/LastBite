<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\store\AuthController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\store\StockController;
use App\Http\Controllers\user\RegisterController as UserRegisterController;
use App\Http\Controllers\user\LoginController as UserLoginController;
use App\Http\Controllers\user\ForgotPasswordController;
use App\Http\Controllers\user\ResetPasswordController;
use App\Http\Controllers\user\ProfileController;
use App\Http\Controllers\user\HomeController;
use App\Http\Controllers\user\EateryController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\Auth\SignupController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\store\RestaurantProfileController;
use App\Models\Customer;
use App\Models\Store;
use App\Models\Pickup;

// =======================
// 🌐 PUBLIC ROUTES
// =======================

Route::get('/', [HomeController::class, 'index'])->name('home.index');

// =======================
// 👤 USER AUTH ROUTES
// =======================

Route::get('/register', [UserRegisterController::class, 'showForm'])->name('register.form');
Route::post('/register', [UserRegisterController::class, 'register'])->name('register.submit');

Route::get('/login', [UserLoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserLoginController::class, 'login'])->name('login.submit');

Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

Route::get('/eatery', [EateryController::class, 'showPage'])
         ->name('user.eatery');

// Route BARU untuk halaman detail dengan parameter {restaurant}
// Nama 'restaurant' harus sama dengan nama variabel di method controller
Route::get('/eatery/{restaurant}', [EateryController::class, 'showDetail'])
         ->name('eatery.detail');

// =======================
// 👤 USER PROTECTED ROUTES
// =======================

Route::prefix('user')->middleware(['auth', 'role:user'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'showProfile'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});

// =======================
// 🏪 STORE (RESTAURANT) ROUTES
// =======================

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


// =======================
// 💳 CHECKOUT & PAYMENT
// =======================

Route::get('/checkout/reserved', function () {
    $customer = Customer::first();
    $store = Store::first();
    $pickup = Pickup::first();
    return view('checkout.reserved', compact('customer', 'store', 'pickup'));
})->name('checkout.reserved');

Route::post('/checkout/reserved', [StripeController::class, 'processReservedInfo'])->name('checkout.processReservedInfo');
Route::get('/checkout/review', [StripeController::class, 'review'])->name('checkout.review');
Route::post('/checkout/stripe', [StripeController::class, 'checkout'])->name('checkout.stripe');
Route::get('/checkout/success', [StripeController::class, 'success'])->name('checkout.success');

// =======================
// 🔐 ADMIN ROUTES (optional)
// =======================
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', function () {
        return 'Admin Dashboard';
    })->name('admin.dashboard');
});


Route::post('/logout', function () {
    Auth::logout();
    return redirect('/'); // arahkan ke home
})->name('logout');
