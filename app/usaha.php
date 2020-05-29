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
        return Usaha::where('user_id', Auth::user()->id)->get(); //ambil data usaha yang sesuai dengan ID user aktif

    }

    public function users()
    {
        return $this->belongsTo('App\User');
    }
}
