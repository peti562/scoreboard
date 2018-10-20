<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Result extends Model
{
  protected $guarded = ['id'];
  use Notifiable;
}
