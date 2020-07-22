<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SubAct extends Model
{
    protected $guarded = [];

    public static function DataSub($id_act)
    {
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
                    ->using('App\SubActResource');
    }

    public function practicalable()
    {
        return$this->morphOne('App\PracticalCapacity', 'practicalable');
    }
}
