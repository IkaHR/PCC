<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActCostRate extends Model
{
    protected $guarded = [];

    public function act()
    {
        return $this->belongsTo('App\Act');
    }
}
