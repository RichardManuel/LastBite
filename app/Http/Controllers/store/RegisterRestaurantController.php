<?php

namespace App\Http\Controllers\store;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterRestaurantController extends Controller
{
    /**
     * Show registration form (email & password).
     */
    public function showRegistrationForm()
    {
        return view('store.signup');
    }

    /**
     * Process initial signup.
     */
    public function processRestoSignup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email', 'unique:restaurants,email'],
            'password' => ['required', 'min:6', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $restaurant = Restaurant::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => 'pending_details',
        ]);

        Auth::guard('resto')->login($restaurant);

        return redirect()->route('resto.register.details.form')->with('success', 'Please complete your restaurant details.');
    }

    /**
     * Show form to complete restaurant details.
     */
    public function showEateryDetailsForm()
    {
        return view('store.registerstore');
    }
}
