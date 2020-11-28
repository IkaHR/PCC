<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DirectExp extends Model
{
    protected $guarded = [];

    public static function DaftarDirectExps()
    {
        //ambil data direct-exps yang sesuai dengan ID usaha aktif
        return DirectExp::where('usaha_id', session('u'))->get();
    }

    public static function DirectUntukProduk()
    {
        // ambil data DirectExp yang tidak memiliki relasi dengan produk_id di sesi 'p'
        return DirectExp::whereDoesntHave('produks', function ($query) {
            $query->where('produk_id', session('p'));
        })
            ->where('usaha_id', session('u'))
            ->get();
    }

    public static function DirectDiProsesHitung($id)
    {
        // ambil data DirectExp yang sesuai dengan $id
        return DirectExp::where('id', $id)->first();
    }

    public function produks()
    {
        return $this->belongsToMany('App\Produk', 'direct_produk', 'direct_id', 'produk_id')
            ->withPivot('kuantitas')
            ->withTimestamps();
    }

    public function usaha()
    {
        return $this->belongsTo('App\Usaha');
    }
}
