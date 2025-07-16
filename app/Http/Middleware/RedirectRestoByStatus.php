<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectRestoByStatus
{
    public function handle(Request $request, Closure $next)
    {
        $restaurant = Auth::guard('resto')->user();

        if (!$restaurant) {
            return redirect()->route('resto.login.form');
        }

        switch ($restaurant->status) {
            case 'pending_details':
                return redirect()->route('resto.register.details.form');
            case 'pending_approval':
                return redirect()->route('resto.pending');
            case 'declined':
                return redirect()->route('resto.rejected');
            case 'accepted':
                return $next($request);
            default:
                return abort(403);
        }
    }
}
