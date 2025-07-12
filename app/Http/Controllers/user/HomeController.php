<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Menampilkan halaman utama (homepage) yang statis.
     */
    public function index()
    {
        // Cukup kembalikan view 'home' tanpa data apa pun.
        return view('user.home');
    }
}
