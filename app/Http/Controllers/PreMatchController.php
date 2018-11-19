<?php

namespace App\Http\Controllers;

use App\Country;
use App\Helpers\MatchHelper;
use App\League;
use App\Match;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class PreMatchController extends Controller
{
    public function photo_input(Request $request, Country $country, Match $match, League $leagues)
    {
      if(!isset($request->from_date)) {
          // From one month ago
          $request->from_date = \Carbon\Carbon::now()->subMonth()->toDateString();
          // Until tomorrow
          $request->to_date   = \Carbon\Carbon::now()->addDay()->toDateString();
      }

      $matches   = MatchHelper::get($request);
      $countries = $country->get();
      $leaguesByCountry = $leagues->get()->groupBy('country_id');


      return view('input.prematch', compact('matches', 'countries', 'leaguesByCountry'));
    }


    public function photo_output()
    {
      echo 'here';
    }
}
