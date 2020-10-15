<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SubAct extends Model
{
    protected $guarded = [];

    public static function DataSub($id_act)
    {
        //ambil data subAct yang sesuai dengan ID Act yang dipilih
        //dengan tambahan penghitungan total detik dan tmu
        //fungsi TRIM()+0 untuk menghilangkan kelebihan 0 diakhir bilangan desimal (trailing 0s)
        return SubAct::select('*',
                DB::raw('TRIM(frekuensi * idx * 0.36)+0 as "detik"'),
                DB::raw('frekuensi * idx * 10 as "tmu"')
            )
            ->where('act_id', '=', $id_act)
            ->get();
    }

    public function act()
    {
        return $this->belongsTo('App\Act');
    }

    public function resources()
    {
        return $this->belongsToMany('App\Resource')
                    ->using('App\ActResource');
    }
}
