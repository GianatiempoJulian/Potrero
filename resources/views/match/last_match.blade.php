@extends('layout')

@section('main-content')


@if ($errors->any())
<div class="alert-container">
    @error('error_msg')
    <h3 class="alert alert-danger">{{$message}}</h3>
    @enderror
</div>
@endif
<h2 class="section-name" style="margin:10px 0px 0px 0px"><img src="{{$team1->picture}}" alt="" style="height:30px; width:30px; margin-right:5px;">{{ $team1->team_name }}</h2>
<h5 class="section-information"> 🏆: {{$team1->matches_win}} ❌: {{$team1->matches_lost}} ⚽: {{$goal_avg_t1}}</h5>
<div class="team-grid">
    @forelse ($team1_players as $player)
    <div class="player-container">
        <img src="{{$player->picture}}" alt="">
        <h3>{{substr($player->first_name,0,1) . ". " . $player->last_name;}}</h3>
        <a class="player-container-info-data">🏟️ <p class="player-container-info-title"> Partidos: </p>{{$player->matches_with_this_team}}</a>
        <a class="player-container-info-data">⚽ <p class="player-container-info-title"> Goles: </p>{{$player->goals_with_this_team}}</a>
        <a class="player-container-info-data">🎯 <p class="player-container-info-title"> Goles Hoy: </p> {{$player->today_goals}}</a>
    </div>
    @empty
    @endforelse
</div>

<div class="last-result">
    <p id="team1-result">
        {{$last->team1_goals}}
    </p>
    <p>-</p>
    <p id="team2-result">
        {{ $last->team2_goals }}
    </p>
    <script>
        var t1_goals = '<?php echo $last->team1_goals ?>';
        var t2_goals = '<?php echo $last->team2_goals ?>';
    </script>
</div>

<h2 class="section-name"><img src="{{$team2->picture}}" alt="" style="height:30px; width:30px; margin-right:5px;">{{ $team2->team_name }}</h2>
<h5 class="section-information">🏆: {{$team2->matches_win}} ❌: {{$team2->matches_lost}} ⚽: {{$goal_avg_t2}}</h5>
<div class="team-grid">
    @forelse ($team2_players as $player)
    <div class="player-container">
        <img src="{{$player->picture}}" alt="">
        <h3>{{substr($player->first_name,0,1) . ". " . $player->last_name;}}</h3>
        <a class="player-container-info-data">🏟️ <p class="player-container-info-title"> Partidos: </p>{{$player->matches_with_this_team}}</a>
        <a class="player-container-info-data">⚽ <p class="player-container-info-title"> Goles: </p>{{$player->goals_with_this_team}}</a>
        <a class="player-container-info-data">🎯 <p class="player-container-info-title"> Goles Hoy: </p> {{$player->today_goals}}</a>
    </div>
    @empty
    @endforelse
</div>

@endsection