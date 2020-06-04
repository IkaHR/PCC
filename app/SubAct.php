<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubAct extends Model
{
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
        return$this-> morphOne('App\PracticalCapacity', 'practicalable');
    }
}
