<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Act extends Model
{
    protected $guarded = [];

    public static function DataActs()
    {
        //ambil data act yang sesuai dengan ID user aktif
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

    public function cost()
    {
        return$this-> morphOne('App\Cost', 'costable');
    }

    public function driverable()
    {
        return$this-> morphOne('App\CostDriver', 'driverable');
    }

    public function practicalable()
    {
        return$this-> morphOne('App\PracticalCapacity', 'practicalable');
    }
}
