<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    public function acts()
    {
        return $this->belongsToMany('App\Act')
                    ->using('App\ActProduk');;
    }
    
    public function direct_costs()
    {
        return $this->belongsTo('App\DirectCost');
    }

    public function cost()
    {
        return$this-> morphOne('App\Cost', 'costable');
    }
}
