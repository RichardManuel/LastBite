<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL; // Jangan lupa ini
use App\Models\Restaurant;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }

        // Binding the 'restaurant_id' parameter
        Route::bind('restaurant_id', function ($value) {
            return Restaurant::where('restaurant_id', $value)->firstOrFail();
        });
    }
}
