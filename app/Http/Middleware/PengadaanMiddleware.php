<?php

namespace App\Http\Middleware;

use Closure;

class PengadaanMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->user()->isAdmin() || auth()->user()->isPengadaan()) {
            return $next($request);
        }

        abort(403, 'User tidak mempunyai hak untuk mengakses halaman ini.');
    }
}
