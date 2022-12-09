@extends('layout')


@section('main-content')


    @if ($errors->any())
    <div class="alert-container">
        @error('error_msg')
        <h3 class="alert alert-danger">{{$message}}</h3>
        @enderror
    </div>
    @endif
    <div class="team-list-box">
        <div class="left-team">
            <img src="{{$teams[0]->picture}}" alt="{{$teams[0]->team_name}}_badge">
            <h1>{{$teams[0]->team_name}}</h1>
            <div class="team-list-data-container">
                <h5 class="team-list-data"><img src="{{ asset('img/pitch.svg') }}" alt="">{{$teams[1]->matches}}</h5>
                <h5 class="team-list-data"><img src="{{ asset('img/trophy.svg') }}" alt="">{{$teams[1]->matches_win}}</h5>
                <h5 class="team-list-data"><img src="{{ asset('img/lose.svg') }}" alt="">{{$teams[1]->matches_lost}}</h5>
            </div>
        </div>
        <div class="right-team">
            <img src="{{$teams[1]->picture}}" alt="{{$teams[1]->team_name}}_badge">
            <h1>{{$teams[1]->team_name}}</h1>
            <div class="team-list-data-container">
                <h5 class="team-list-data"><img src="{{ asset('img/pitch.svg') }}" alt="">{{$teams[1]->matches}}</h5>
                <h5 class="team-list-data"><img src="{{ asset('img/trophy.svg') }}" alt="">{{$teams[1]->matches_win}}</h5>
                <h5 class="team-list-data"><img src="{{ asset('img/lose.svg') }}" alt="">{{$teams[1]->matches_lost}}</h5>
            </div>
        </div>
    </div>
</form>

@endsection