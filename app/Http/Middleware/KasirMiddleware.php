<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class KasirMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = session('user');
        if (!$user || $user['type_akun'] !== 'kasir') {
            return redirect('/')->with('error', 'Akses ditolak.');
        }
        return $next($request);
    }
}
