<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('user.signin');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();
            if ($user->roles === 'admin') {
                return redirect()->route('admin.restaurants.index');
            }

            return redirect()->intended('/'); // untuk user biasa
        }

        return back()->withErrors([
            'email' => 'Invalid credentials.',
        ])->withInput();
    }
}
