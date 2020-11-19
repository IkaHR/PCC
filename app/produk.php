<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Produk extends Model
{
    protected $guarded = [];

    public static function DaftarProduk()
    {
        //ambil data produk yang sesuai dengan ID user aktif
        return Produk::with(['acts', 'directs'])
                    ->select('*',
                        DB::raw('TRIM( kuantitas )+0 as "kuantitas"')
                    )
                    ->where('usaha_id', session('u'))
                    ->get();
    }

    public function acts()
    {
        return $this->belongsToMany('App\Act', 'act_produk', 'produk_id', 'act_id')
                    ->withPivot('frekuensi')
                    ->withTimestamps();
    }

    public function directs()
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
