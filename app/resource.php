<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    protected $guarded = [];

    public static function DaftarResources()
    {
        return Resource::where('usaha_id', session('u'))->get(); //ambil data usaha yang sesuai dengan ID user aktif
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
}
