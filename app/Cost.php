<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cost extends Model
{
    public function costable()
    {
        return $this->morphTo();
    }
}
