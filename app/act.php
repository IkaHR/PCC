<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Act extends Model
{
    protected $guarded = [];

    public static function DataActs()
    {
        /*
         * ambil data act yang sesuai dengan ID user aktif
         * dengan tambahan penghitungan total menit dan totalTMU
         * data pengitungan diambil dari tabel subAct yang berhubungan
         * fungsi TRIM()+0 untuk menghilangkan kelebihan 0 diakhir bilangan desimal (trailing 0s)
        */

        return Act::with(['sub_acts', 'resources'])
            ->addSelect([
                'menit' => SubAct::selectRaw('TRIM(SUM(frekuensi * idx * 0.36) / 60)+0 as "menit"')
                ->whereColumn('act_id', 'acts.id'),
                'totalTMU' => SubAct::selectRaw('SUM(frekuensi * idx * 10) as "totalTMU"')
                ->whereColumn('act_id', 'acts.id'),
            ])
            ->where('usaha_id', session('u'))
            ->get();
    }

    public static function ActUntukProduk()
    {
        /*
         * ambil data ACT yang:
         * sesuai dengan ID usaha aktif
         * dan belum terhubung dengan PRODUK pada sesi 'p'
        */

        return Act::whereDoesntHave('produks', function ($query) {
            $query->where('produk_id', session('p'));
        })
            ->where('usaha_id', session('u'))
            ->get();
    }

    public function usaha()
    {
        return $this->belongsTo('App\Usaha');
    }

    public function produks()
    {
        return $this->belongsToMany('App\Produk', 'act_produk', 'act_id', 'produk_id')
                    ->withPivot('frekuensi')
                    ->withTimestamps();
    }

    public function sub_acts()
    {
        return $this->hasMany('App\SubAct');
    }

    public function resources()
    {
        return $this->belongsToMany( 'App\Resource' , 'act_resource', 'act_id', 'resource_id')
                    ->withPivot('kuantitas')
                    ->withTimestamps();
    }
}
