<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $roles)
    {
        if (!Auth::check()) {
            return redirect()->route('login.form');
        }

        if (Auth::user()->roles !== $roles) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}
