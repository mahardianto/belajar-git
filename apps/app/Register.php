<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Register extends Model
{
    //
    public function city()
    {
        return $this->belongsTo('App\City');
    }

    public function images()
    {
        return $this->hasMany('App\Image');
    }

    public function materials()
    {
        return $this->hasMany('App\Material');
    }

    public function artifact()
    {
        return $this->hasOne('App\Artifact');
    }
}
