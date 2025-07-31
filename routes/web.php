<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

// Models
use App\Models\User;
use App\Models\Restaurant;
use App\Models\Pickup;
use App\Models\Order;

// User Controllers
use App\Http\Controllers\user\RegisterController as UserRegisterController;
use App\Http\Controllers\user\LoginController as UserLoginController;
use App\Http\Controllers\user\ForgotPasswordController;
use App\Http\Controllers\user\ResetPasswordController;
use App\Http\Controllers\user\ProfileController;
use App\Http\Controllers\user\HomeController;
use App\Http\Controllers\user\EateryController;
use App\Http\Controllers\user\OrderController;
use App\Http\Controllers\user\StripeController;
use App\Http\Controllers\user\RatingController;

// Restaurant Controllers
use App\Http\Controllers\store\AuthController;
use App\Http\Controllers\store\StockController;
use App\Http\Controllers\store\RestaurantProfileController;
use App\Http\Controllers\store\RegisterRestaurantController;
use App\Http\Controllers\store\OrderController as storeOrderController;
use App\Http\Controllers\Auth\LoginController as storeLoginController;


// Admin Controllers
use App\Http\Controllers\Admin\RestaurantApplicationController;
use App\Http\Controllers\Admin\RestaurantManagementController;

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

// =======================
// 🍽 EATERY PUBLIC ROUTES
// =======================
Route::get('/eatery', [EateryController::class, 'showPage'])->name('user.eatery');
Route::get('/eatery/{restaurant}', [EateryController::class, 'showDetail'])->name('eatery.detail');

// =======================
// 👤 USER PROTECTED ROUTES
// =======================
Route::prefix('user')->middleware(['auth', 'role:user'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'showProfile'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});

// =======================
// 🍽 RESTAURANT REGISTRATION & AUTH
// =======================
Route::get('/store/signup', [RegisterRestaurantController::class, 'showRegistrationForm'])->name('resto.signup.form');
Route::post('/store/signup', [RegisterRestaurantController::class, 'processRestoSignup'])->name('resto.signup.submit');

Route::get('/store/signin', [storeLoginController::class, 'showRestoLoginForm'])->name('resto.login.form');
Route::post('/store/signin', [storeLoginController::class, 'restoLogin'])->name('resto.login.submit');
Route::post('/store/logout', [storeLoginController::class, 'restoLogout'])->name('resto.logout');

// =======================
// 🍽 RESTAURANT PROTECTED ROUTES
// =======================

// Tahap 1: Belum aktif (Pending, Rejected, Suspended)
Route::prefix('store')
    ->name('resto.')
    ->middleware(['auth:resto'])
    ->group(function () {
        Route::get('/register-details', [RegisterRestaurantController::class, 'showEateryDetailsForm'])->name('register.details.form');
        Route::post('/register-details', [RestaurantProfileController::class, 'storeOrUpdateDetails'])->name('register.details.submit');

        Route::get('/pending', fn() => view('store.application_pending'))->name('pending');
        Route::get('/rejected', fn() => view('store.application_rejected'))->name('rejected');
        Route::get('/suspended', fn() => view('store.resto_suspended'))->name('suspended');
    });

// Tahap 2: Restoran aktif (verified)
// Tahap 2: Restoran aktif (verified)
Route::prefix('store')
    ->name('resto.')
    ->middleware(['auth:resto', 'resto.status'])
    ->group(function () {
        // Profile
        Route::get('/profile', [RestaurantProfileController::class, 'show'])->name('profile.show');
        Route::get('/restaurant/profile/edit', [RestaurantProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/restaurant/profile/update', [RestaurantProfileController::class, 'update'])->name('profile.update');

        // Stock
        Route::get('/stock/manage', [StockController::class, 'manageStock'])->name('stock.manage');
        Route::get('/stock/fetch', [StockController::class, 'fetchStock'])->name('stock.fetch');
        Route::post('/stock/update', [StockController::class, 'updateStock'])->name('stock.update');

        // ✅ Tambahkan Order Management di sini juga
        Route::get('/orders', [StoreOrderController::class, 'index'])->name('orders.index');
        Route::put('/orders/{order_id}', [StoreOrderController::class, 'update'])->name('orders.update');
        Route::put('/orders/{order}/status', [StoreOrderController::class, 'updateStatus'])->name('orders.updateStatus');
    });
Route::post('/api/ratings', [RatingController::class, 'store']);


// =======================
// 💳 CHECKOUT & PAYMENT
// =======================
Route::get('/checkout/reserved', [StripeController::class, 'showReservedPage'])->name('checkout.reserved.show');
Route::post('/checkout/reserved', [StripeController::class, 'processReservedInfo'])->name('checkout.reserved.store');
Route::post('/checkout/reserved/update-pickup', [StripeController::class, 'updatePickup'])->name('checkout.pickup.update');

Route::get('/checkout/review', [StripeController::class, 'review'])->name('checkout.review.show');
Route::post('/checkout/stripe', [StripeController::class, 'checkout'])->name('checkout.stripe');

Route::get('/checkout/success', [StripeController::class, 'success'])->name('checkout.success');
Route::get('/checkout/confirmation', [StripeController::class, 'showConfirmationPage'])->name('checkout.confirmation');

// =======================
// 📦 USER ORDER HISTORY
// =======================
Route::get('/order', [OrderController::class, 'index'])->name('order');
Route::get('/order/{id}', [OrderController::class, 'show'])->name('order.show');

// =======================
// 🔐 ADMIN ROUTES
// =======================
Route::prefix('admin')
    ->middleware(['auth', 'role:admin'])
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', fn() => redirect()->route('admin.restaurants.index'))->name('dashboard');

        // Pengajuan restoran
        Route::get('/restaurants', [RestaurantApplicationController::class, 'showPage'])->name('restaurants.index');
        Route::post('/restaurants/{restaurant}/accept', [RestaurantApplicationController::class, 'accept'])->name('restaurants.accept');
        Route::delete('/restaurants/{restaurant}/decline', [RestaurantApplicationController::class, 'decline'])->name('restaurants.decline');

        // Manajemen restoran
        Route::get('/management', [RestaurantManagementController::class, 'showPage'])->name('management.index');
        Route::post('/management/suspend/{restaurant_id}', [RestaurantManagementController::class, 'suspend'])->name('management.suspend');
        Route::post('/management/unsuspend/{restaurant_id}', [RestaurantManagementController::class, 'unsuspend'])->name('management.unsuspend');
        Route::delete('/management/{restaurant_id}', [RestaurantManagementController::class, 'destroy'])->name('management.destroy');
    });

// =======================
// 🚪 LOGOUT USER
// =======================
Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('login');
})->name('logout');
