<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CostDriver extends Model
{
    public function driverable()
    {
        return $this->morphTo();
    }
}
