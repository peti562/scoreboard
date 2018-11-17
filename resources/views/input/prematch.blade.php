{{--@extends('layouts.index')--}}
@extends ('master')

@section('content')

    <!-- DataTables Example -->
    <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-table"></i>
            Matches from Yesterday, Today and Tomorrow</div>
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
                        <th>Pre-Match Photo</th>
                        <th>Result Photo</th>
                    </tr>
                    </thead>
                    <tfoot

                    <tr class="text-center">
                        <th>Home Team</th>
                        <th>Away Team</th>
                        <th>Score</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Pre-Match Photo</th>
                        <th>Result Photo</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($matches as $match)
                        <tr class="text-center">
                            <td class="text-left">{{htmlspecialchars_decode($match['match_hometeam_name'])}}</td>
                            <td class="text-left">{{htmlspecialchars_decode($match['match_awayteam_name'])}}</td>
                            <td>{{$match['match_hometeam_score']}} - {{$match['match_awayteam_score']}}</td>
                            <td>{{$match['match_date']}}</td>
                            <td>{{$match['match_time']}}</td>
                            <td>
                                {{Form::open(['route' => 'prematch_photo_output', 'files' => false])}}
                                {{ csrf_field() }}
                                <input type="hidden" name="match_id" value="{{$match['match_id']}}">
                                <div class="col l12 m12">
                                    {{Form::submit('Generate Pre-Match Photo!', ['class' => 'btn btn-info btn-block'])}}
                                    {{Form::close()}}
                                </div>
                            </td>
                            <td>
                                {{Form::open(['route' => ['result_photo_output', $match['match_id']], 'files' => false])}}
                                {{ csrf_field() }}
                                <input type="hidden" name="match_id" value="{{$match['match_id']}}">
                                <div class="col l12 m12">
                                    {{Form::submit('Generate Result Photo!', ['class' => 'btn btn-primary btn-block'])}}
                                    {{Form::close()}}
                                </div>
                            </td>
                        </tr>


                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
        <div class="card-footer small text-muted"></div>
    </div>


@endsection