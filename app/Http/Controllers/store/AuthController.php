<?php

// app/Http/Controllers/Store/AuthController.php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('store.auth.login'); // Pastikan view ini tersedia di resources/views/store/auth/login.blade.php
    }

}
