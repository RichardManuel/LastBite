<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\store\AuthController;
use App\Http\Controllers\store\StockController;
use App\Http\Controllers\user\RegisterController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/store/signin', [AuthController::class, 'loginForm'])->name('signin');

Route::post('/login', [AuthController::class, 'login'])->name('login'); // the missing route


Route::get('/store/stocks', [StockController::class, 'index']);
Route::post('/stocks/update', [StockController::class, 'update']);

Route::get('/user/editprofile', function (){
    return view('user.editprofile');
});
Route::get('/user/regist', function (){
    return view('user.register');
});


Route::get('/register', [RegisterController::class, 'showForm'])->name('register.form');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

use App\Http\Controllers\user\LoginController;

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
