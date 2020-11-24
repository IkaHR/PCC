<?php

namespace App\Http\Middleware;

use Closure;

class HapusSesiProses
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
        /*
         * Hapus sesi:
         *
         * 'a' = act_id
         * 'p' = produk_id
        */

        session()->forget(['a', 'p']);

        return $next($request);
    }
}
