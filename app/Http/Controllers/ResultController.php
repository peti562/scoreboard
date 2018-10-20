<?php

namespace App\Http\Controllers;

use App\Notifications\ArticlePublished;
use App\Result;
use App\Team;
use GuzzleHttp\Client;
use function GuzzleHttp\uri_template;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;

class ResultController extends Controller {

  use Notifiable;

  public function photo_output(Request $request, Team $team)
  {
    $match = $this->getMatch($request['match_id'])[0];
    /*$match = $this->getMatch(293760)[0];*/
    $imageURL = url('images/england.jpg');
    $image_template = url('/images/wcresultimage.png');


    $home_team = $this->getTeam($match['match_hometeam_name'], $team);
    $away_team = $this->getTeam($match['match_awayteam_name'], $team);
    $data = [
      'home_team' => $home_team['Team'],
      'home_team_crest' => url('/images/generator/team_logos/'.$home_team['Logo_url']),
      'home_team_goals' => $match['match_hometeam_score'],
      'home_team_name' => $match['match_hometeam_name'],
      'away_team' => $away_team['Team'],
      'away_team_crest' => url('/images/generator/team_logos/'.$away_team['Logo_url']),
      'away_team_goals' => $match['match_awayteam_score'],
      'away_team_name' => $match['match_awayteam_name'],
      'background_image' => $imageURL,
      'image_template' => $image_template,
    ];

    return view('output.result_photo_output', compact('data'));

  }

  public function getTeam($name, $team)
  {
    $selectedTeam = $team->where('Team', $name)->get()->toArray();
    return $selectedTeam[0];
  }

  public function getMatch($match_id)
  {

    $client = new Client();
    $res = $client->get(
      'https://apifootball.com/api/',
      [
        'query'   => [
          'action' => 'get_events',
          'match_id' => $match_id,
          'APIkey'   => 'cc004d0093ef1578d7360fc3e9ad49dfc24b504288a4374711b76daa451fea96',
        ],
        'headers' => [
          'content-type' => 'application/json',
        ],
      ]
    );
    $response = \GuzzleHttp\json_decode($res->getBody(), true);
    return $response;
  }
  public function postToFacebook(Request $request)
  {
    $result = Result::create([
      'title' => $request['title'],
      'img_url' => $request['title']
    ]);
    $result->notify(new ArticlePublished);
  }
}
