<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    protected $guarded = [];

    public static function DaftarResources()
    {
        //ambil data resource yang sesuai dengan ID usaha aktif
        return Resource::where('usaha_id', session('u'))->get();
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
