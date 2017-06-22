<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Artifact extends Model
{
    //
    public function register()
    {
        return $this->belongsTo('App\Register');
    }

    public function rack()
    {
        return $this->belongsTo('App\Rack');
    }

    public function form()
    {
        return $this->belongsTo('App\Form');
    }
}
