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
        //dd($this->match);

        $this->match['home_team_crest'] = url(
            '/images/generator/team_logos/'.$this->homeTeam->country->name.'/'.str_replace(' ', '', $this->homeTeam->name).'.svg'
        );

        $this->match['away_team_crest'] = url(
            '/images/generator/team_logos/'.$this->awayTeam->country->name.'/'.str_replace(' ', '', $this->awayTeam->name).'.svg'
        );

        $lineup_home = collect($this->match['lineup']['home']['starting_lineups']);
        $lineup_away = collect($this->match['lineup']['away']['starting_lineups']);

        $this->match['lineup']['home']['starting_lineups'] = $lineup_home->sortBy('lineup_position')->values()->toArray();
        $this->match['lineup']['away']['starting_lineups'] = $lineup_away->sortBy('lineup_position')->values()->toArray();

        $this->match['colors'] = [
            'home' => [
                'color1'    => $this->homeTeam->color1,
                'color2'    => $this->homeTeam->color2,
                'color3'    => $this->homeTeam->color3,
                'color4'    => $this->homeTeam->color4,
            ],
            'away' => [
                'color1'    => $this->awayTeam->color1,
                'color2'    => $this->awayTeam->color2,
                'color3'    => $this->awayTeam->color3,
                'color4'    => $this->awayTeam->color4,
            ]
        ];

        $this->match['background_image']  = $this->imageURL;
        $this->match['image_template']    = $this->image_template;

    }


    public function result()
    {
        $data = $this->match;
        foreach ($this->match['goalscorer'] as $goal)
        {
            $this->team = strlen($goal['home_scorer']) > 1 ? 'home' : 'away';
            $data['goals'][$this->team][] = [
              'scorer'  => '('.$goal['time'].') '.trim(substr($goal[$this->team.'_scorer'], 3))
            ];
        }
        $data['canvasWidth'] = 900;
        $data['canvasHeight'] = 1000;
        $data['font-type'] = 'epl-font';
        $data['image_type'] = 'result';
        return view('output.photo', compact('data'));
    }

    public function lineups() {
        $data = $this->match;
        $data['canvasWidth'] = 900;
        $data['canvasHeight'] = 1000;
        $data['font_type'] = 'epl-font';
        $data['image_type'] = 'lineups';

        return view('output.photo', compact('data'));
    }

    public function getimage(){
        $client = new Client();

        $url = 'http://localhost:8080/generate/lineups/32434';
        $file_path = 'public';
        $res = $client->get($url, ['save_to' => $file_path]);


        dd($res);
        $response = \GuzzleHttp\json_decode($res->getBody(), true);

        return $response;
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
