<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestoProfileController;


Route::get('/', function () {
    return view('profilestore');
});

Route::resource('resto/profile', RestoProfileController::class);

