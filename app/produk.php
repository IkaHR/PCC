<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $guarded = [];

    public static function DaftarProduk()
    {
        //ambil data produk yang sesuai dengan ID user aktif
        return Produk::where('usaha_id', session('u'))->get();
    }

    public function acts()
    {
        return $this->belongsToMany('App\Act')
                    ->using('App\ActProduk');
    }

    public function direct_exps()
    {
        return $this->belongsTo('App\DirectExp');
    }

    public function cost()
    {
        return$this-> morphOne('App\Cost', 'costable');
    }

    public function usaha()
    {
        return $this->belongsTo('App\Usaha');
    }
}
