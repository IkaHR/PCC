<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Produk extends Model
{
    protected $guarded = [];

    public static function DaftarProduk()
    {
        return Produk::where('usaha_id', session('u'))->get(); //ambil data usaha yang sesuai dengan ID user aktif

    }

    public function acts()
    {
        return $this->belongsToMany('App\Act')
                    ->using('App\ActProduk');;
    }

    public function direct_costs()
    {
        return $this->belongsTo('App\DirectCost');
    }

    public function cost()
    {
        return$this-> morphOne('App\Cost', 'costable');
    }
}
