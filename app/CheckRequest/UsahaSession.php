<?php

namespace App\CheckRequest;

use Closure;

class UsahaSession
{
    public function handle ($request, Closure $next)
    {
        //dari RequestSession
        //periksa status request, jika false ...
        if ($request == false){

            //jika sesi tidak memiliki u, kembali ke controller, minta redirect ke home
            if ( ! session()->has('u')){
                $request = false;
                return $next($request);
            }
            //status request = true, jika session memiliki u
            $request = true;
            return $next($request);
        }

        //status request = true, dari RequestSession
        return $next($request);
    }
}
