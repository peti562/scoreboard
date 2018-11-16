@extends ('master')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Hunfield Road</title>
    <link href="{{asset('css/custom.css')}}" type="text/css" rel="stylesheet">
</head>
<body style="font-family: epl-font;">
<div class="col l12 col m12">
    <style>
        @import url({{url('font/Premier_League_Font_2018.ttf')}});
        @import url({{url('font/Dusha.ttf')}});

        @font-face {
            font-family: epl-font;
            src: url({{url('font/Premier_League_Font_2018.ttf')}});
        }
        @font-face {
            font-family: wc-font;
            src: url({{url('font/Dusha.ttf')}});
        }
    </style>
    <span style="font: 40px epl-font;">.</span>
    <canvas
            width="700"
            height="864"
            id="canvas"></canvas>
</div>

<button onclick="savingTheCanvas()">SAVE</button>

<script>
    var data = {
        background_image: '{{$data['background_image']}}',
        image_template: '{{$data['image_template']}}',
        home_team_name: '{{$data['home_team_name']}}',
        away_team_name: '{{$data['away_team_name']}}',
        home_goals: '{{$data['home_team_goals']}}',
        away_goals: '{{$data['away_team_goals']}}',
        home_crest: '{{$data['home_team_crest']}}',
        away_crest: '{{$data['away_team_crest']}}',
    };

</script>
<script src="{{asset('js/canvas.js')}}"></script>

</body>
</html>
@endsection