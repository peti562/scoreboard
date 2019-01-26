{{--@extends('layouts.index')--}}
@extends ('master')

@section('content')


    <div class="card mb-3">
        <div class="card-header">

            <form action="{{ url('/prematch') }}">
                <div class="row mb-3">
                    <div class="col-md-3">
                        <label for="countries">Select Country</label>
                        <select class="custom-select form-control" name="country_id" id="countries">
                            @foreach($countries as $country)
                                @if($selected['country'] == $country['id'])
                                    <option selected value="{{ $country['id'] }}">{{ $country['name']}}</option>
                                @else
                                    <option value="{{ $country['id'] }}">{{ $country['name']}}</option>
                                @endif;
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="leagues">Select League</label>
                        <select class="custom-select" name="league_id" id="leagues">
                            @foreach($leaguesByCountry[$selected['country']] as $league)
                                @if($selected['league'] == $league['id'])
                                    <option selected value="{{ $league['id'] }}">{{ $league['name']}}</option>
                                @else
                                    <option value="{{ $league['id'] }}">{{ $league['name']}}</option>
                                @endif;
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="dates" style="color:white;">. </label>
                        <input style="cursor: default" id="dates" name="dates" value="{{ $selected['from_date'] }} - {{ $selected['to_date'] }}" class="form-control">
                        <input value="{{ $selected['from_date'] }}" id="from_date" name="from_date" class="btn btn-default btn-block" type="hidden">
                        <input value="{{ $selected['to_date'] }}" id="to_date" name="to_date" class="btn btn-default btn-block" type="hidden">
                    </div>
                    <div class="col-md-3">
                        <label for="search" style="color:white;">. </label>
                        <button type="submit" id="search" class="btn btn-warning btn-block">Search</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr class="text-center">
                        <th>Home Team</th>
                        <th>Away Team</th>
                        <th>Score</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Live Automatic</th>
                        <th>Manual Generating</th>
                    </tr>
                    </thead>
                    <tfoot>

                    <tr class="text-center">
                        <th>Home Team</th>
                        <th>Away Team</th>
                        <th>Score</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Live Automatic</th>
                        <th>Manual Generating</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @if(isset($matches['error']))
                        <h3 class="text-center" style="color:#bd5652;">No matches found, please select a different dates or competition.</h3>
                    @else
                        @foreach($matches as $match)
                            <tr class="text-center">
                                <td class="text-left">{{htmlspecialchars_decode($match['match_hometeam_name'])}}</td>
                                <td class="text-left">{{htmlspecialchars_decode($match['match_awayteam_name'])}}</td>
                                <td>{{$match['match_hometeam_score']}} - {{$match['match_awayteam_score']}}</td>
                                <td>{{$match['match_date']}}</td>
                                <td>{{$match['match_time']}}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-secondary" data-toggle="button" aria-pressed="false" autocomplete="off">
                                            Matchday
                                        </button>
                                        <button type="button" class="btn btn-secondary" data-toggle="button" aria-pressed="false" autocomplete="off">
                                            Lineup
                                        </button>
                                        <button type="button" class="btn btn-secondary" data-toggle="button" aria-pressed="false" autocomplete="off">
                                            Goal
                                        </button>
                                        <button type="button" class="btn btn-secondary" data-toggle="button" aria-pressed="false" autocomplete="off">
                                            Result
                                        </button>
                                    </div>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-info" aria-pressed="false" autocomplete="off">
                                            Matchday
                                        </button>
                                        <button type="button" class="btn btn-info" aria-pressed="false" autocomplete="off">
                                            Lineup
                                        </button>
                                        <button type="button" class="btn btn-info" aria-pressed="false" autocomplete="off">
                                            Goal
                                        </button>
                                        <button type="button" class="btn btn-info" aria-pressed="false" autocomplete="off">
                                            Result
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>

            </div>
        </div>
        <div class="card-footer small text-muted"></div>
    </div>

<script>
    var leagues = <?=json_encode($leaguesByCountry)?>;
</script>
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <script src="{{asset('js/prematch/default.js')}}"></script>

@endsection