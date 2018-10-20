<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class PreMatchController extends Controller
{
    public function photo_input()
    {
      $matches = $this->getMatches();
      return view('input.prematch', compact('matches'));
    }

    public function getMatches()
    {

      $client = new Client();

      $today = \Carbon\Carbon::now()->toDateString();
      $yesterday = \Carbon\Carbon::now()->subDay()->toDateString();
      $tomorrow = \Carbon\Carbon::now()->addDay()->toDateString();

      $res = $client->get('https://apifootball.com/api/',
        [
          'query' => [
            'action' => 'get_events',
            'country_id' => '169',
            'league_id' => '62',
            'from' => $yesterday,
            'to' => $tomorrow,
            'APIkey' => config('app.apiKey')
          ],
          'headers' => [
            'content-type' => 'application/json'
          ]
        ]);
      $response = \GuzzleHttp\json_decode($res->getBody(), true);
      return $response;
    }

    public function photo_output()
    {
      echo 'here';
    }
}
