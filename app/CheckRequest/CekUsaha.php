<?php

namespace App\CheckRequest;

use App\Usaha;
use Closure;

class CekUsaha
{
    public function handle ($request, Closure $next)
    {
        //dari AksesUsaha
        //periksa status request, jika true ...
        if ($request == true){

            //ambil semua id data usaha dari user yang aktif
            $semuausaha = Usaha::DaftarUsaha('id');

            //cek apakah id dalam $u ada dalam databasa Table Usaha
            if (!$semuausaha->contains(session('u'))) {
                return abort(404);
            }

            //status request = true, jika user memiliki akses ke usaha
            $request = true;
            return $next($request);
        }

        //status request = false, dari AksesUsaha
        return $next($request);
    }

}
