<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Resource extends Model
{
    protected $guarded = [];

    public static function DaftarResourcesPanjang()
    {
        //ambil data resource yang sesuai dengan ID usaha aktif
        //fungsi TRIM()+0 untuk menghilangkan kelebihan 0 diakhir bilangan desimal (trailing 0s)
        return Resource::select('*',
            DB::raw('TRIM(umur)+0 as "umur"'),
            DB::raw('TRIM(kuantitas)+0 as "kuantitas"'),
            DB::raw('TRIM(((biaya/umur)+perawatan)*kuantitas)+0 as "pertahun"')
        )
            ->where('usaha_id', session('u'))
            ->where('jenis', 1)
            ->get();
    }
    public static function DaftarResourcesPendek()
    {
        //ambil data resource yang sesuai dengan ID usaha aktif
        //fungsi TRIM()+0 untuk menghilangkan kelebihan 0 diakhir bilangan desimal (trailing 0s)
        return Resource::select('*',
            DB::raw('TRIM(umur)+0 as "umur"')
        )
            ->where('usaha_id', session('u'))
            ->where('jenis', 2)
            ->get();
    }

    public function acts()
    {
        return $this->belongsToMany('App\SubAct')
                    ->using('App\SubActResource');
    }

    public function usaha()
    {
        return $this->belongsTo('App\Usaha');
    }
}
