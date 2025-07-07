<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\store\AuthController;
use App\Http\Controllers\store\StockController;
use App\Http\Controllers\user\RegisterController as UserRegisterController;
use App\Http\Controllers\user\LoginController as UserLoginController;
use App\Http\Controllers\user\ForgotPasswordController;
use App\Http\Controllers\user\ResetPasswordController;
use App\Http\Controllers\user\ProfileController;
use App\Http\Controllers\Auth\LoginController as StoreLoginController;
use App\Http\Controllers\Auth\RegisterController as StoreRegisterController;
use App\Http\Controllers\RestaurantProfileController;
use App\Http\Controllers\StripeController;
use App\Models\Customer;
use App\Models\Store;
use App\Models\Pickup;

// =======================
// 🌐 PUBLIC ROUTES
// =======================

Route::get('/', function () {
    return view('welcome');
});

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

// Pendaftaran restoran
Route::get('/store/signup', [StoreRegisterController::class, 'showRegistrationForm'])->name('resto.signup.form');
Route::post('/store/signup', [StoreRegisterController::class, 'processRestoSignup'])->name('resto.signup.submit');

// Login/logout restoran
Route::get('/store/signin', [StoreLoginController::class, 'showRestoLoginForm'])->name('resto.login.form');
Route::post('/store/signin', [StoreLoginController::class, 'restoLogin'])->name('resto.login.submit');
Route::post('/store/logout', [StoreLoginController::class, 'restoLogout'])->name('resto.logout');

// Rute yang membutuhkan guard 'resto'
Route::middleware('auth:resto')->prefix('store')->name('resto.')->group(function () {
    // Detail lanjutan pendaftaran
    Route::get('/register-details', [StoreRegisterController::class, 'showEateryDetailsForm'])->name('register.details.form');
    Route::post('/register-details', [RestaurantProfileController::class, 'storeOrUpdateDetails'])->name('register.details.submit');

    // Profil restoran
    Route::get('/profile', [RestaurantProfileController::class, 'show'])->name('profile.show');
    Route::get('/restaurant/profile/edit', [RestaurantProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/restaurant/profile/update', [RestaurantProfileController::class, 'update'])->name('profile.update');

    // Stok makanan
    Route::get('/stocks', [StockController::class, 'index'])->name('stocks.index');
    Route::post('/stocks/update', [StockController::class, 'update'])->name('stocks.update');
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
