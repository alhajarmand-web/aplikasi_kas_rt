<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle($request, Closure $next, ...$roles)
    {
        // belum login
        if (!auth()->check()) {
            return redirect('/login');
        }

        // kalau role TIDAK sesuai → TOLAK (bukan redirect)
        if (!in_array(auth()->user()->role, $roles)) {
            abort(403, 'Akses ditolak');
        }

        return $next($request);
    }
}