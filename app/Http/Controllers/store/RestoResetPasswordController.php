<?php

namespace App\Http\Controllers\store;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\store;


class RestoResetPasswordController extends Controller
{
    public function showRestoResetForm(Request $request, $token)
    {
        return view('store.resetpassword', [
            'token' => $token,
            'email' => $request->query('email'),
        ]);
        
    }
    public function resetResto(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($restaurant, $password) {
                // dd('reset works',$store->email,$password);
                $restaurant->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('resto.login.form')->with('success', 'Password has been reset!')
            : back()->withErrors(['email' => __($status)]);
    }
}
