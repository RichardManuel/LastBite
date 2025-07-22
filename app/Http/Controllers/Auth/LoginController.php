<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Menampilkan form login untuk Resto.
     */
    public function showRestoLoginForm()
    {
        return view('store.signin');
    }

    /**
     * Menangani permintaan login untuk Resto.
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

            $restaurant = Auth::guard('resto')->user(); // Ambil objek restoran yang sedang login

            // Cek status restoran setelah login
            if ($restaurant->status === 'accepted') {
                return redirect()->route('resto.profile.show')
                    ->with('success', 'Login successful! Welcome back.');
            } elseif ($restaurant->status === 'pending_details') {
                return redirect()->route('resto.register.details.form')
                    ->with('info', 'Please complete your eatery registration details.');
            } elseif ($restaurant->status === 'pending_review') {
                return back()->withErrors(['email' => 'Your eatery account is pending admin approval.'])->onlyInput('email');
            } elseif ($restaurant->status === 'rejected' || $restaurant->status === 'inactive') {
                return back()->withErrors(['email' => 'Your eatery account was rejected or is inactive.'])->onlyInput('email');
            } else {
                return back()->withErrors(['email' => 'Invalid account status.'])->onlyInput('email');
            }
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

        return redirect('/store/signin');
    }
}
