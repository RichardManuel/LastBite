<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StripeController;
use App\Models\Customer;
use App\Models\Store;
use App\Models\Pickup;

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