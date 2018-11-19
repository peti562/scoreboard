<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Countries extends Model
{
    public function team()
    {
        return $this->hasMany('App\Team');
    }

    public function league()
    {
        return $this->hasMany('App\Leagues');
    }
}
