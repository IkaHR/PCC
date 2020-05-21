<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usaha extends Model
{
    /*protected $fillable = [
        'user_id', 
    ];*/

    protected $guarded = [];


    public function users()
    {
        return $this->belongsTo('App\User');
    }
}
