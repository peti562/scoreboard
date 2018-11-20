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


      $matches   = MatchHelper::get($request);
      $countries = $country->get()->sortBy('name');
      $leaguesByCountry = $leagues->get()->groupBy('country_id');
      $selected = [
          'country' => $request->country_id,
          'league'  => $request->league_id,
      ];

      return view('input.prematch',
          compact('matches',
              'countries',
                'leaguesByCountry',
                'selected'));
    }


    public function photo_output()
    {
      echo 'here';
    }
}
