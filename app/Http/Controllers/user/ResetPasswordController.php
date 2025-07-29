<?php

namespace App\Http\Controllers\user;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;


class ResetPasswordController extends Controller
{
    public function showResetForm(Request $request, $token)
    {
        return view('user.resetpassword', [
            'token' => $token,
            'email' => $request->query('email'),
        ]);
        
    }
    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                // dd('reset works',$user->email,$password);
                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login.form')->with('success', 'Password has been reset!')
            : back()->withErrors(['email' => __($status)]);
    }
}
