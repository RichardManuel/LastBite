<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Tampilkan formulir login untuk Resto.
     */
    public function showRestoLoginForm()
    {
        return view('store.signin');
    }

    /**
     * Tangani permintaan login untuk Resto.
     */
    public function restoLogin(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        // Coba login menggunakan guard 'resto'
        if (Auth::guard('resto')->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            
            // PENTING: Hapus semua logika pengalihan di sini.
            // Biarkan middleware 'RedirectRestoByStatus' menangani pengalihan berdasarkan status.
            return redirect()->route('resto.profile.show')
                ->with('success', 'Login successful! Welcome back.');
        }

        // Jika login gagal
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Menangani permintaan logout untuk Resto.
     */
    public function restoLogout(Request $request)
    {
        Auth::guard('resto')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
