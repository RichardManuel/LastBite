<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use App\Notifications\CustomResetPassword;

class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('user.forgetpassword'); // Blade file for forgot password
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email not found.']);
        }

        $token = Password::createToken($user); // manually generate token
        $user->notify(new CustomResetPassword($token)); // send custom email

        return back()->with('status', 'Reset link sent!');
    }
}