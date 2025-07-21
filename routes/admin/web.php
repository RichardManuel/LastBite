<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RestaurantApplicationController; // Pastikan ini di-import
use App\Http\Controllers\Admin\RestaurantManagementController;

// Rute utama, arahkan ke halaman admin
Route::get('/', function () {
    return redirect()->route('admin.applications.index');
});

// Grup untuk semua rute admin
Route::prefix('admin')->group(function () {

    // --- RUTE HALAMAN (yang diketik di browser) ---
    
    // URL: /admin/applications -> memanggil metode showPage()
    Route::get('/applications', [RestaurantApplicationController::class, 'showPage'])
         ->name('admin.applications.index');

    // URL: /admin/management -> menampilkan view langsung
   Route::get('/management', [RestaurantManagementController::class, 'showPage'])
         ->name('admin.management.index');

    Route::post('/applications/{application}/accept', [RestaurantApplicationController::class, 'accept'])
     ->name('admin.applications.accept');

    Route::delete('/applications/{application}/decline', [RestaurantApplicationController::class, 'decline'])
        ->name('admin.applications.decline');

    Route::delete('/restaurants/{restaurant}', [RestaurantManagementController::class, 'destroy'])
         ->name('admin.restaurants.destroy');
}); 