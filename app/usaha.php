<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usaha extends Model
{
    public function users()
    {
        return $this->belongsTo('App\User');
    }
}
