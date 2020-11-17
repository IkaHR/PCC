<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $guarded = [];

    public static function DaftarProduk()
    {
        //ambil data produk yang sesuai dengan ID user aktif
        return Produk::with(['acts'])
                        ->where('usaha_id', session('u'))
                        ->get();
    }

    public function acts()
    {
        return $this->belongsToMany('App\Act', 'act_produk', 'produk_id', 'act_id')
                    ->withPivot('frekuensi')
                    ->withTimestamps();
    }

    public function direct_exps()
    {
        return $this->belongsToMany('App\DirectExp', 'direct_produk', 'produk_id', 'direct_id')
                    ->withPivot('kuantitas')
                    ->withTimestamps();
    }

    public function usaha()
    {
        return $this->belongsTo('App\Usaha');
    }
}
