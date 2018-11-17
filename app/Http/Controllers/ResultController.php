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
        $match_id = '343800';
        if ($request->match_id) {
            $match = Match::getById($request->match_id);
        } else {
            $match = Match::getById($match_id);
        }

        $imageURL = url('images/england.jpg');
        $image_template = url('/images/wcresultimage.png');


        $team->home = $team->where('name', $match['match_hometeam_name'])->first();
        $team->away = $team->where('name', $match['match_awayteam_name'])->first();

        $team->home->name = htmlspecialchars_decode($team->home->name);
        $team->away->name = htmlspecialchars_decode($team->away->name);

        $data = [
            'home_team' => $team->home->name,
            'home_team_crest' => url(
                '/images/generator/team_logos/'.$team->home->country->name.'/'.str_replace(' ', '', $team->home->name).'.svg'
            ),
            'home_team_goals' => $match['match_hometeam_score'],
            'home_team_name' => $match['match_hometeam_name'],
            'away_team' => $team->away->name,
            'away_team_crest' => url(
                '/images/generator/team_logos/'.$team->away->country->name.'/'.str_replace(' ', '', $team->away->name).'.svg'
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
              'scorer'  => '('.$goal['time'].') '.trim(substr($goal[$team.'_scorer'], 3))
            ];
        }

        return view('output.result_photo_output', compact('data'));

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
