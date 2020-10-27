<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Act extends Model
{
    protected $guarded = [];

    public static function DataActs()
    {
        //ambil data act yang sesuai dengan ID user aktif
        //dengan tambahan penghitungan total menit dan totalTMU
        //data pengitungan diambil dari tabel subAct yang berhubungan
        //fungsi TRIM()+0 untuk menghilangkan kelebihan 0 diakhir bilangan desimal (trailing 0s)
        return Act::addSelect([
                'menit' => SubAct::selectRaw('TRIM(SUM(frekuensi * idx * 0.36) / 60)+0 as "menit"')
                ->whereColumn('act_id', 'acts.id'),
                'totalTMU' => SubAct::selectRaw('SUM(frekuensi * idx * 10) as "totalTMU"')
                ->whereColumn('act_id', 'acts.id'),
            ])
            ->where('usaha_id', session('u'))
            ->get();
    }

    public function usaha()
    {
        return $this->belongsTo('App\Usaha');
    }

    public function produks()
    {
        return $this->belongsToMany('App\Produk')
                    ->using('App\ActProduk');
    }

    public function sub_acts()
    {
        return $this->hasMany('App\SubAct');
    }

    public function resources()
    {
        return $this->belongsToMany('App\Resource')
            ->using('App\ActResource');
    }
}
