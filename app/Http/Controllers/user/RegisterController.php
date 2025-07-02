<?php

namespace App\Http\Controllers\user;

use App\Models\User;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showForm()
    {
        return view('user.register'); // Your Blade view name
    }

    public function register(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'city' => 'required|string|max:100',
            'phone' => 'required|string|max:20',
            'password' => 'required|string|min:6|confirmed',
            'terms' => 'accepted',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'city' => $request->city,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'notes'=>null,
        ]);

        return redirect('/login')->with('success', 'Account created successfully!');
    }
}
