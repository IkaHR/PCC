<?php

namespace App\Http\Middleware;

use App\Usaha;
use Closure;

class PeriksaAksesUsaha
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
        //jika request tidak memiliki parameter u
        if ( ! request()->has('u') ) {

            // periksa apakah ada sesi 'u' yang aktif
            // jika tidak, redirect ke home
            if ( ! session()->has('u')){

                return redirect()->route('home')
                    ->with('notif', 'Sesi telah berakhir! Silahkan memulai kembali Badan Usaha yang ingin dikelolah. ');

            }

            //jika ada sesi 'u' yang aktif, lanjutkan proses
            return $next($request);

        }

        // jika request memiliki 'u' maka:
        // ambil semua id data usaha dari user yang aktif
        $semuausaha = Usaha::DaftarUsaha()->pluck('id');

        // cek apakah user memiliki akses pada usaha dengan id 'u'
        // jika tidak, batalkan operasi
        if (!$semuausaha->contains(request('u'))) {

            return abort(404);

        }

        // jika user memiliki akses pada usaha dengan id 'u'
        // simpan id dari request 'u' ke variabel
        session(['u' => request('u')]);

        return $next($request);
    }
}
