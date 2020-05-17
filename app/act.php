<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Act extends Model
{
    public function produks()
    {
        return $this->belongsToMany('App\Produk')
                    ->using('App\ActProduk');
    }
    
    public function cost()
    {
        return$this-> morphOne('App\Cost', 'costable');
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
