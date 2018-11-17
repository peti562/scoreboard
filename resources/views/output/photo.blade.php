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
            width="900"
            height="1000"
            id="canvas">
    </canvas>
</div>

<button onclick="savingTheCanvas()">SAVE</button>

<script>

    var data = <?=json_encode($data)?>;

</script>
<script src="{{asset('js/Photo.js')}}"></script>
<script src="{{asset('js/'.$data['image_type'].'.js')}}"></script>

</body>
</html>
@endsection