<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Resource extends Model
{
    protected $guarded = [];

    public static function DaftarResources()
    {
        //ambil data resource yang sesuai dengan ID usaha aktif
        return Resource::select('*',
            DB::raw('TRIM(umur)+0 as "umur"'),
            DB::raw('TRIM(kuantitas)+0 as "kuantitas"')
        )->where('usaha_id', session('u'))->get();
    }

    public function acts()
    {
        return $this->belongsToMany('App\SubAct')
                    ->using('App\SubActResource');
    }

    public function driverable()
    {
        return$this-> morphOne('App\CostDriver', 'driverable');
    }

    public function practicalable()
    {
        return$this-> morphOne('App\PracticalCapacity', 'practicalable');
    }

    public function usaha()
    {
        return $this->belongsTo('App\Usaha');
    }
}
