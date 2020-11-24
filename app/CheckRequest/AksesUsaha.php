<?php

namespace App\CheckRequest;

use Closure;

class AksesUsaha
{
    public function handle ($request, Closure $next)
    {
        //cek jika url tidak memiliki parameter u
        if ( ! request()->has('u') ) {

            //jika sesi tidak memiliki u, kembali ke controller, minta redirect ke home
            if ( ! session()->has('u')){
                $request = false;
                return $next($request);
            }

            //jikz id dalam u ada pada data $semuausaha
            //status request true, lanjut ke CekUsaha
            $request = true;
            return $next($request);

        }

        // jika request memiliki 'u' maka:
        //simpan data dari parameter u ke variabel
        $u = request('u');
        session(['u' => $u]); //simpan data dari variabel ke session

        //jika url memiliki parameter u, status request = true
        //lanjut ke CekUsaha
        $request = true;
        return $next($request);
    }

}
