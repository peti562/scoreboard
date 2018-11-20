<?php

namespace App\Helpers;

use GuzzleHttp\Client;
use http\Env\Request;
use Illuminate\Support\Facades\DB;

class MatchHelper {

  public static function get($request) {
    $client = new Client();

      if(!isset($request->from_date)) {
          // From one month ago
          $request->from_date = \Carbon\Carbon::now()->subMonth()->toDateString();
      }
      if(!isset($request->to_date)) {
          // Until tomorrow
          $request->to_date   = \Carbon\Carbon::now()->addDay()->toDateString();
      }
      if(!isset($request->country_id)) {
          $request->country_id = '169';
      }
      if(!isset($request->league_id)) {
          $request->league_id = '63';
      }

    $res = $client->get('https://apifootball.com/api/',
      [
        'query' => [
          'action'       => 'get_events',
          'country_id'   => $request->country_id,
          'league_id'    => $request->league_id, // 62 - EPL, 63 - CHAMPIONSHIP
          'from'         => $request->from_date,
          'to'           => $request->to_date,
          'APIkey'       => config('app.apiKey')
        ],
        'headers' => [
          'content-type' => 'application/json'
        ]
      ]);

    $response = \GuzzleHttp\json_decode($res->getBody(), true);

    return $response;

  }

  public static function getById($match_id) {
    $client = new Client();
    $res = $client->get('https://apifootball.com/api/',
      [
        'query'   => [
          'action' => 'get_events',
          'match_id' => $match_id,
          'APIkey'   => config('app.apiKey'),
        ],
        'headers' => [
          'content-type' => 'application/json',
        ],
      ]
    );
    $response = \GuzzleHttp\json_decode($res->getBody(), true);
    return $response[0];
  }

}