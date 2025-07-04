<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\AuthenticationException;

class Authenticate
{
    public function handle(Request $request, Closure $next, ...$guards)
    {
        if (Auth::check()) {
            return $next($request);
        }

        throw new AuthenticationException(
            'Unauthenticated.',
            $guards,
            route('login.form') // 🔁 Redirect route when not logged in
        );
    }
}
