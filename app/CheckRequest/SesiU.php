<?php

namespace App\CheckRequest;

use App\Usaha;
use Closure;

class SesiU
{
    public function handle ($request, Closure $next)
    {
        //jika sesi tidak memiliki u, kembali ke controller, minta redirect ke home
        if ( ! session()->has('u')){
            $request = false;
            return $next($request);
        }

        //jika sesi memiliki u, maka ..
        //ambil semua id data usaha dari user yang aktif
        $semuausaha = Usaha::DaftarUsaha('id');

        //cek apakah id dalam $u ada dalam databasa Table Usaha
        if ( ! $semuausaha->contains(session('u'))) {
            return abort(404);
        }

        //status request = true, jika user memiliki akses ke usaha
        $request = true;
        return $next($request);
    }

}
