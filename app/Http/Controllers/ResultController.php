<?php

namespace App\Http\Controllers;

use App\Helpers\Match;
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
        $match_id = '368889';

        $match = Match::getById($match_id);

        $imageURL = url('images/england.jpg');
        $image_template = url('/images/wcresultimage.png');


        $home_team = $this->getTeam($match['match_hometeam_name'], $team);
        $away_team = $this->getTeam($match['match_awayteam_name'], $team);
        $data = [
            'home_team' => $home_team['team_name'],
            'home_team_crest' => url(
                '/images/generator/team_logos/'.$home_team->country->name.'/'.$home_team->name.'.svg'
            ),
            'home_team_goals' => $match['match_hometeam_score'],
            'home_team_name' => $match['match_hometeam_name'],
            'away_team' => $away_team['team_name'],
            'away_team_crest' => url(
                '/images/generator/team_logos/'.$away_team->country->name.'/'.$away_team->name.'.svg'
            ),
            'away_team_goals' => $match['match_awayteam_score'],
            'away_team_name' => $match['match_awayteam_name'],
            'background_image' => $imageURL,
            'image_template' => $image_template,
            'colors' => [
                'lineabove' => '#ffffff',
                'block' => '#9D1016',
                'ribbon' => '#F9C83F',
                'ribbontext' => '#000000',
                'result' => '#ffffff',
            ],
        ];

        foreach ($match['goalscorer'] as $goal)
        {
            $team = strlen($goal['home_scorer']) > 1 ? 'home' : 'away';
            $data['goals'][$team][] = [
              'time'    => $goal['time'],
              'scorer'  => trim(substr($goal[$team.'_scorer'], 3))
            ];
        }

        return view('output.result_photo_output', compact('data'));

    }

    public function getTeam($name, $team)
    {
        $selectedTeam = $team->where('name', $name)->first();

        return $selectedTeam;
    }

    public function postToFacebook(Request $request)
    {
        $result = Result::create(
            [
                'title' => $request['title'],
                'img_url' => $request['title'],
            ]
        );
        $result->notify(new ArticlePublished);
    }
}
