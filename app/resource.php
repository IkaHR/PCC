<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Resource extends Model
{
    protected $guarded = [];

    public static function SemuaResource()
    {
        //ambil SEMUA data resource yang sesuai dengan ID usaha aktif
        // 1 tahun = 525600 menit
        //fungsi TRIM()+0 untuk menghilangkan kelebihan 0 diakhir bilangan desimal (trailing 0s)
        return Resource::select('*',
            DB::raw('( (biaya / umur) + perawatan) * kuantitas as "pertahun"'),
            DB::raw('( ( (biaya / umur) + perawatan) * kuantitas ) / 525600 as "permenit"')
        )
            ->where('usaha_id', session('u'))
            ->get();
    }

    public static function DaftarResourcesPanjang()
    {
        //ambil data resource JANGKA PANJANG yang sesuai dengan ID usaha aktif
        //fungsi TRIM()+0 untuk menghilangkan kelebihan 0 diakhir bilangan desimal (trailing 0s)
        return Resource::select('*',
            DB::raw('TRIM( umur )+0 as "umur"'),
            DB::raw('TRIM( kuantitas )+0 as "kuantitas"'),
            DB::raw('TRIM( ( (biaya / umur ) + perawatan) * kuantitas )+0 as "pertahun"')
        )
            ->where('usaha_id', session('u'))
            ->where('jenis', 1)
            ->get();
    }

    public static function DaftarResourcesPendek()
    {
        //ambil data resource JANGKA PENDEK yang sesuai dengan ID usaha aktif
        //fungsi TRIM()+0 untuk menghilangkan kelebihan 0 diakhir bilangan desimal (trailing 0s)
        return Resource::select('*',
            DB::raw('TRIM( umur )+0 as "umur"')
        )
            ->where('usaha_id', session('u'))
            ->where('jenis', 2)
            ->get();
    }

    public static function ResourcesPanjangUntukAct()
    {
        /*
         * ambil data resource JANGKA PANJANG yang:
         * sesuai dengan ID usaha aktif
         * dan belum terhubung dengan ACT pada sesi 'a'
        */
        return Resource::whereDoesntHave('acts', function ($query) {
            $query->where('act_id', session('a'));
        })
            ->where('jenis', 1)
            ->where('usaha_id', session('u'))
            ->get();
    }

    public static function ResourcesPendekUntukAct()
    {
        /*
         * ambil data resource JANGKA PENDEK yang:
         * sesuai dengan ID usaha aktif
         * dan belum terhubung dengan ACT pada sesi 'a'
        */
        return Resource::whereDoesntHave('acts', function ($query) {
            $query->where('act_id', session('a'));
        })
            ->where('jenis', 2)
            ->where('usaha_id', session('u'))
            ->get();
    }

    public function acts()
    {
        return $this->belongsToMany('App\Act', 'act_resource', 'resource_id', 'act_id')
                    ->withPivot('kuantitas')
                    ->withTimestamps();
    }

    public function usaha()
    {
        return $this->belongsTo('App\Usaha');
    }
}
