<?php

namespace App\Http\Controllers;

use App\Helpers\Match;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class PreMatchController extends Controller
{
    public function photo_input()
    {
      // From one month ago
      $from = \Carbon\Carbon::now()->subMonth()->toDateString();
      // Until tomorrow
      $to = \Carbon\Carbon::now()->addDay()->toDateString();

      $matches = Match::getBetween($from, $to);

      return view('input.prematch', compact('matches'));
    }


    public function photo_output()
    {
      echo 'here';
    }
}
