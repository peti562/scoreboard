{{--@extends('layouts.index')--}}
@extends ('voyager::master')

@section('content')


    @foreach($matches as $match)

        <div class="col-md-4 matchcard" style="background-color: <?= $match['match_date'] == \Carbon\Carbon::now()->toDateString() ? '#abfca0' : '#d8d8d8'?> ">
            <div class="col-md-6 text-right" style="color: <?= $match['match_live'] == 1 ? 'red' : 'black;' ?>;">
                {{$match['match_hometeam_name']}}     {{$match['match_hometeam_score']}}
            </div>
            <div class="col-md-6" style="color: <?= $match['match_live'] == 1 ? 'red' : 'black;' ?>;">
                {{$match['match_awayteam_score']}}     {{$match['match_awayteam_name']}}
            </div>

          <?= $match['match_live'] == 1 ? '<div class="col-md-12 text-center">LIVE</div>' : '' ?>

            <div class="col-md-12 text-center">
                {{$match['match_date']}} - {{$match['match_time']}}
            </div>

            {{-- prematch photo generating--}}
            {{Form::open(['route' => 'prematch_photo_output', 'files' => false])}}
            {{ csrf_field() }}
            <input type="hidden" name="match_id" value="{{$match['match_id']}}">
            <div class="col l12 m12">
                {{Form::submit('Generate Pre-Match Photo!', ['class' => 'btn btn-info'])}}
                {{Form::close()}}
            </div>
            {{-- end of prematch photo generating--}}

            {{-- post-match result photo generating--}}
            {{Form::open(['route' => 'result_photo_output', 'files' => false])}}
            {{ csrf_field() }}
            <input type="hidden" name="match_id" value="{{$match['match_id']}}">
            <div class="col l12 m12">
                {{Form::submit('Generate Result Photo!', ['class' => 'btn btn-warning'])}}
                {{Form::close()}}
            </div>
            {{-- end of post-match result photo generating--}}

        </div>
    @endforeach
@endsection