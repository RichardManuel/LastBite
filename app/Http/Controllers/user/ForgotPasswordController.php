<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use App\Notifications\CustomResetPassword; // Assuming you have a custom notification

class ForgotPasswordController extends Controller
{
    /**
     * Show the form to request a password reset link.
     *
     * @return \Illuminate\View\View
     */
    public function showLinkRequestForm()
    {
        return view('user.forgetpassword');
    }

    /**
     * Send a reset link to the given user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $user = User::where('email', $request->email)->first();

        // No need for an 'if (!$user)' check here because 'exists' validation
        // already ensures the email exists. The call below will handle it gracefully.

        // Get the 'users' password broker and create a token.
        // This method automatically saves the token to the 'password_reset_tokens' table.
        $token = Password::broker('users')->createToken($user);
        
        // Use your custom notification to send the email with the generated token.
        $user->notify(new CustomResetPassword($token));

        return back()->with('status', 'Reset link sent!');
    }
}