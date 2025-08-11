<?php

namespace App\Http\Controllers\store;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Models\Restaurant;
use App\Notifications\CustomResetRestoPassword;

class RestoForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('store.forgetpassword'); // Blade file for forgot password
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:restaurants,email',
        ]);

        $restaurants = Restaurant::where('email', $request->email)->first();

        if (!$restaurants) {
            return back()->withErrors(['email' => 'Email not found.']);
        }

        $token = Password::createToken($restaurants); // manually generate token
        $restaurants->notify(new CustomResetRestoPassword($token)); // send custom email

        return back()->with('status', 'Reset link sent!');
    }
}