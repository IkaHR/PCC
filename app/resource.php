<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    
    public function acts()
    {
        return $this->belongsToMany('App\SubAct')
                    ->using('App\SubActResource');
    }    
    
    public function driverable()
    {
        return$this-> morphOne('App\CostDriver', 'driverable');
    }
    
    public function practicalable()
    {
        return$this-> morphOne('App\PracticalCapacity', 'practicalable');
    }
}
