<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
  public function country()
  {
      return $this->belongsTo('App\Countries');
  }
}
