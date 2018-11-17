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

class GeneratorController extends Controller {

    public function __construct(Request $request, Team $team)
    {
        $match_id = '343800';
        if ($request->match_id) {
            $this->match = Match::getById($request->match_id);
        } else {
            $this->match = Match::getById($match_id);
        }

        $this->imageURL = url('images/england.jpg');
        $this->image_template = url('/images/wcresultimage.png');

        $this->homeTeam = $team->where('name', $this->match['match_hometeam_name'])->first();
        $this->awayTeam = $team->where('name', $this->match['match_awayteam_name'])->first();

        $this->homeTeam->name = htmlspecialchars_decode($this->homeTeam->name);
        $this->awayTeam->name = htmlspecialchars_decode($this->awayTeam->name);
    }

    use Notifiable;

    public function result(Request $request, Team $team)
    {

        $data = [
            'home_team' => $this->homeTeam->name,
            'home_team_crest' => url(
                '/images/generator/team_logos/'.$this->homeTeam->country->name.'/'.str_replace(' ', '', $this->homeTeam->name).'.svg'
            ),
            'home_team_goals' => $this->match['match_hometeam_score'],
            'home_team_name' => $this->match['match_hometeam_name'],
            'away_team' => $this->awayTeam->name,
            'away_team_crest' => url(
                '/images/generator/team_logos/'.$this->awayTeam->country->name.'/'.str_replace(' ', '', $this->awayTeam->name).'.svg'
            ),
            'away_team_goals' => $this->match['match_awayteam_score'],
            'away_team_name' => $this->match['match_awayteam_name'],
            'background_image' => $this->imageURL,
            'image_template' => $this->image_template,
            'colors' => [
                'lineabove' => '#ffffff',
                'block' => '#9D1016',
                'ribbon' => '#F9C83F',
                'ribbontext' => '#000000',
                'result' => '#ffffff',
            ],
        ];

        foreach ($this->match['goalscorer'] as $goal)
        {
            $this->team = strlen($goal['home_scorer']) > 1 ? 'home' : 'away';
            $data['goals'][$this->team][] = [
              'scorer'  => '('.$goal['time'].') '.trim(substr($goal[$this->team.'_scorer'], 3))
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
