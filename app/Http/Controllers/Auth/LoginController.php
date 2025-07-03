<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use App\Models\Restaurant; // Tidak perlu di sini jika hanya Auth::guard('resto')

class LoginController extends Controller
{
    /**
     * Menampilkan form login untuk Resto.
     */
    public function showRestoLoginForm() // Akan dipanggil oleh route GET /store/signin
    {
        // View: resources/views/store/signin.blade.php
        return view('store.signin');
    }

    /**
     * Menangani permintaan login untuk Resto.
     */
    public function restoLogin(Request $request) // Akan dipanggil oleh route POST /store/signin
    {
        $credentials = $request->validate([
            'email' => ['required', 'string', 'email'], // Sesuaikan nama field input
            'password' => ['required', 'string'],
        ]);

        // Coba login menggunakan guard 'resto'
        // Pastikan field 'email_login' di form sesuai dengan yang diharapkan di sini
        if (Auth::guard('resto')->attempt(['email' => $request->email, 'password' => $request->password], $request->boolean('remember'))) {
            $request->session()->regenerate();
            $restaurant = Auth::guard('resto')->user(); // Ini adalah objek Restaurant

            if ($restaurant->status_approval === 'approved') {
                return redirect()->intended(route('resto.profile.show'))->with('success', 'Login successful! Welcome back.'); // Arahkan ke profil resto
            } elseif ($restaurant->status_approval === 'pending_details') {
                Auth::guard('resto')->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect()->route('resto.register.details.form')->with('info', 'Please complete your eatery registration details.');
            } elseif ($restaurant->status_approval === 'pending_review') {
                Auth::guard('resto')->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return back()->withErrors(['email' => 'Your eatery account is pending admin approval.'])->onlyInput('email');
            } elseif ($restaurant->status_approval === 'rejected' || $restaurant->status_approval === 'inactive') {
                Auth::guard('resto')->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return back()->withErrors(['email' => 'Your eatery account was rejected or is inactive.'])->onlyInput('email');
            } else {
                Auth::guard('resto')->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return back()->withErrors(['email' => 'Invalid account status.'])->onlyInput('email');
            }
        }

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