<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RedirectRestoByStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $restaurant = Auth::guard('resto')->user();
        
        // Jika tidak ada user resto yang terautentikasi, alihkan ke halaman login
        if (!$restaurant) {
            return redirect()->route('resto.login.form');
        }
        
        // Tentukan rute tujuan berdasarkan status
        $intendedRouteName = null;
        switch ($restaurant->status) {
            case 'pending_details':
                $intendedRouteName = 'resto.register.details.form';
                break;
            case 'pending_approval':
                $intendedRouteName = 'resto.pending';
                break;
            case 'declined':
                $intendedRouteName = 'resto.rejected';
                break;
            case 'suspended':
                $intendedRouteName = 'resto.suspended';
                break;
            case 'accepted':
                // Untuk status 'accepted', tidak perlu dialihkan. Lanjutkan ke rute yang diminta.
                return $next($request);
            default:
                // Tangani status yang tidak dikenal
                return abort(403, 'Invalid restaurant status.');
        }

        // Kunci untuk mencegah looping!
        // Periksa apakah rute saat ini BUKAN rute yang seharusnya dituju.
        // HANYA lakukan pengalihan jika metodenya BUKAN POST.
        if ($intendedRouteName && !$request->routeIs($intendedRouteName) && $request->method() !== 'POST') {
            return redirect()->route($intendedRouteName);
        }

        // Jika pengguna sudah berada di halaman yang benar (contoh: di resto.pending),
        // atau jika statusnya 'accepted', maka lanjutkan permintaan.
        // Jika metodenya POST, biarkan controller yang menangani pengalihan
        // untuk mencegah loop.
        return $next($request);
    }
}
