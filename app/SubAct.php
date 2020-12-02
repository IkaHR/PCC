<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SubAct extends Model
{
    protected $guarded = [];

    public static function DataSub($id_act)
    {
        /*
         * ambil data subAct yang sesuai dengan ID Act yang dipilih
         * hanya bisa diakses lewat lamat edit Act
         * dengan tambahan penghitungan total detik dan tmu
         *
         * TMU = index * 10
         * contoh: kegiatan dengan index 19 = 190 TMU
         * 1 TMU = 0,036 detik
        */

        return SubAct::select('*',
                DB::raw('idx * 10 * 0.036 as "detik"'),
                DB::raw('idx * 10 as "tmu"')
            )
            ->where('act_id', $id_act)
            ->get();
    }

    public static function SubsDiBlade($id)
    {
        /*
         * ambil data subAct yang sesuai dengan ID yang dipilih
         * diakses dari laporan
         * dengan tambahan penghitungan total detik dan tmu
         *
         * TMU = index * 10
         * contoh: kegiatan dengan index 19 = 190 TMU
         * 1 TMU = 0,036 detik
        */

        return SubAct::select('*',
                DB::raw('idx * 10 * 0.036 as "detik"'),
                DB::raw('idx * 10 as "tmu"')
            )
            ->where('id', $id)
            ->first();
    }

    public function act()
    {
        return $this->belongsTo('App\Act');
    }
}
