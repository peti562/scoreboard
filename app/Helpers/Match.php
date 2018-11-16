<?php

namespace App\Helpers;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;

class Match {

  public static function getBetween($from, $to) {
    $client = new Client();

    $res = $client->get('https://apifootball.com/api/',
      [
        'query' => [
          'action' => 'get_events',
          'country_id' => '169',
          'league_id' => '62',
          'from' => $from,
          'to' => $to,
          'APIkey' => config('app.apiKey')
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