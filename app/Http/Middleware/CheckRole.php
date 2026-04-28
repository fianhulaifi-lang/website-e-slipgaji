<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Jika belum login
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'Silakan Login Dulu');
        }

        // Ambil role user login
        $userRole = strtolower(trim(Auth::user()->role));

        // Rapikan role dari route
        $roles = array_map(function ($role) {
            return strtolower(trim($role));
        }, $roles);

        // Jika role tidak sesuai
        if (!in_array($userRole, $roles)) {
            abort(403, 'Akses Ditolak');
        }

        return $next($request);
    }
}