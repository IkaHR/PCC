<?php

namespace App\CheckRequest;

use Closure;

class RequestSession
{
    public function handle ($request, Closure $next)
    {
        //cek jika url tidak memiliki parameter u
        if ( ! request()->has('u') ) {

            //maka status request = false
            $request = false;

            //lanjut ke UsahaSession
            return $next($request);
        }

        //simpan data dari parameter u ke variabel
        $u = request('u');
        session(['u' => $u]); //simpan data dari variabel ke session

        //jika url memiliki parameter u, status request = true
        $request = true;

        //lanjut ke UsahaSession
        return $next($request);
    }

}
