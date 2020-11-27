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
         *
         * TMU = index * 10
         * contoh: kegiatan dengan index 19 = 190 TMU
         * 1 TMU = 0,036 detik
        */

        return Act::with(['sub_acts', 'resources', 'act_costrate'])
            ->addSelect([
                'menit' => SubAct::selectRaw('TRIM(SUM(idx * 10 * 0.036) / 60)+0 as "menit"')
                ->whereColumn('act_id', 'acts.id'),
                'totalTMU' => SubAct::selectRaw('SUM(idx * 10) as "totalTMU"')
                ->whereColumn('act_id', 'acts.id'),
            ])
            ->where('usaha_id', session('u'))
            ->get();
    }

    public static function ActsDiBlade($id)
    {
        /*
         * Penggunaan: produks.edit blade view
         * ambil data act yang sesuai dengan ID var $id
         * dengan tambahan penghitungan total menit
         * data pengitungan diambil dari tabel subAct yang berhubungan
         * fungsi TRIM()+0 untuk menghilangkan kelebihan 0 diakhir bilangan desimal (trailing 0s)
        */

        return Act::with(['sub_acts', 'act_costrate'])
            ->addSelect([
                'menit' => SubAct::selectRaw('TRIM(SUM(idx * 10 * 0.036) / 60)+0 as "menit"')
                ->whereColumn('act_id', 'acts.id'),
            ])
            ->where('id', $id)
            ->first();
    }

    public static function ActUntukProduk()
    {
        /*
         * ambil data ACT yang:
         * sesuai dengan ID usaha aktif
         * belum terhubung dengan PRODUK pada sesi 'p'
         * memiliki sub-act & resource
        */

        return Act::whereDoesntHave('produks', function ($query) {
            $query->where('produk_id', session('p'));
        })
            ->whereHas('sub_acts')
            ->whereHas('resources')
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

    public function act_costrate()
    {
        return $this->hasOne('App\ActCostRate', 'act_id');
    }
}
