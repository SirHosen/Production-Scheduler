<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Jika pengguna tidak login
        if (!$request->user()) {
            return redirect('login');
        }

        // Jika $roles kosong atau user adalah admin, izinkan akses
        if (empty($roles) || $request->user()->hasRole('admin')) {
            return $next($request);
        }

        // Periksa apakah user memiliki salah satu role yang diizinkan
        foreach ($roles as $role) {
            if ($request->user()->hasRole($role)) {
                return $next($request);
            }
        }

        // Jika tidak memiliki role yang diizinkan, tampilkan error 403
        abort(403, 'Unauthorized action.');
    }
}
