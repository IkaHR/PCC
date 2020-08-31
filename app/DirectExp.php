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
        return DirectExp::select('*',
            DB::raw('TRIM(kuantitas)+0 as "kuantitas"')
        )->where('usaha_id', session('u'))->get();
    }

    public function usaha()
    {
        return $this->belongsTo('App\Usaha');
    }
}