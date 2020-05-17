<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PracticalCapacity extends Model
{
    public function practicalable()
    {
        return $this->morphTo();
    }
}
