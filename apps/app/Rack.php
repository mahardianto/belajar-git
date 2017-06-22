<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rack extends Model
{
    //
    public function room()
    {
        return $this->belongsTo('App\Room');
    }

    public function artifacts()
    {
        return $this->hasMany('App\Artifact');
    }
}
