<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Usaha extends Model
{

    protected $guarded = [];

    public static function usahaAktif()
    {
        //ambil record pertama dari usaha yang id-nya sama dengan di session
        return Usaha::where('id', session('u'))->first();
    }

    public static function DaftarUsaha()
    {
        //ambil data usaha yang sesuai dengan ID user aktif
        return Usaha::where('user_id', Auth::user()->id)->get();
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function produks()
    {
        return $this->hasMany('App\Produk');
    }

    public function resources()
    {
        return $this->hasMany('App\Resource');
    }

    public function acts()
    {
        return $this->hasMany('App\Act');
    }

    public function directExps()
    {
        return $this->hasMany('App\DirectExp');
    }
}
