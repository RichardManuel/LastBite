<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;  // Add this import
use App\Models\Restaurant;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        // Binding the 'restaurant_id' parameter to the Restaurant model
        Route::bind('restaurant_id', function ($value) {
            return Restaurant::where('restaurant_id', $value)->firstOrFail();
        });
    }
}
