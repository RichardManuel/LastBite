<?php

namespace App\Http\Controllers;

// Kita tidak lagi butuh 'Restaurant' atau 'Request'
// use App\Models\Restaurant;
// use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Menampilkan halaman utama (homepage) yang statis.
     */
    public function index()
    {
        // Cukup kembalikan view 'home' tanpa data apa pun.
        return view('home');
    }
}