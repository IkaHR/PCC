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

    public function users()
    {
        return $this->belongsTo('App\User');
    }
}
