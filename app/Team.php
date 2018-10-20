<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
  public function scopeTeam ($query, $team) {
    return $query->where('Team', $team);
  }
}
