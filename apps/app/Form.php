<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    //
    public function type()
    {
        return $this->belongsTo('App\Type');
    }

    public function artifact()
    {
        return $this->hasOne('App\artifact');
    }
}
