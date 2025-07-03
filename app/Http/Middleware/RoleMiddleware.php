<?php

namespace App\Http\Middleware; // Pastikan namespace ini

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Untuk mengakses informasi user yang login
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware // Pastikan nama class ini
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  ...$roles  // Ini akan menangkap argumen setelah tanda ':' (misal, 'resto')
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 1. Cek apakah user sudah login. Jika belum, biarkan middleware 'auth' yang menangani
        //    atau arahkan ke halaman login.
        if (!Auth::check()) {
            return redirect()->route('login'); // Pastikan route 'login' sudah ada
        }

        $user = Auth::user(); // Dapatkan user yang sedang login

        // 2. Cek apakah user memiliki salah satu peran yang diizinkan
        foreach ($roles as $role) {
            // Asumsi: Model User Anda memiliki atribut/kolom bernama 'role'
            // dan nilainya adalah string seperti 'user', 'resto', 'admin'
            if (isset($user->role) && $user->role == $role) {
                return $next($request); // Jika peran cocok, lanjutkan request
            }
        }

        // 3. Jika tidak ada peran yang cocok, kembalikan error atau redirect
        // abort(403, 'UNAUTHORIZED ACTION.'); // Opsi 1: Halaman error 403
        return redirect('/')->with('error', 'You do not have permission to access this page.'); // Opsi 2: Redirect ke home dengan pesan
    }
}