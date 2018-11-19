<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class League extends Model
{
    public function countries()
    {
        return $this->belongsTo('App\Country');
    }
}
