<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->type_akun === 'admin') {
            return $next($request);
        }

        abort(403, 'Akses ditolak. Hanya untuk Admin.');
    }
}
