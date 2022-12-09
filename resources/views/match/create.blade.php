@extends('layout')

@section('main-content')



<h1 class="section-name" style="margin:20px 0px">Cargar datos del partido.</h1>
<form method="POST" action="{{ url('partidos/guardar') }}">
    @csrf
    @if ($errors->any())
    <div class="alert-container">
        @error('error_msg')
        <h3 class="alert alert-danger">{{$message}}</h3>
        @enderror
    </div>
    @endif
    <h3 class="section-information">Seleccione al ganador.</h3>
    <div class="team-info-update-grid">
        @forelse ($teams as $team)
        <div class="match-result">
            <input type="radio" name="team_win" value="{{ $team->team_id }}">
            <label for="team_win">{{$team->team_name}}</label><br>
            @error('team_win')
            <p class="error-msg">{{$message}}</p>
            @enderror
            <input class="custom-input-update" style="width:100px; text-align: left;" type="number" name="team_goals[]" min=0 max=9999 placeholder="Goles">
            <input type="hidden" name='team_id[]' value='{{ $team->team_id }}'>
            @error('team_goals.0')
            <p class="error-msg">{{$message}}</p>
            @enderror
        </div>
        @empty
        @endforelse
    </div>



    <div class="team-update-grid">
        @forelse ($players as $player)
        <div class="player-update-container">
            <img src="{{$player->picture}}" alt="">
            <h3>{{substr($player->first_name,0,1) . ". " . $player->last_name;}}</h3>
            <label for="">Goles hoy: </label>
            <input class="custom-input-update" type="number" name='today_goals[]' id='today_goals'>
            <input type="hidden" name='player_id[]' value='{{ $player->player_id }}'>

        </div>
        @empty
        @endforelse
        
    </div>
    <div class="update-end">
            <button type="submit">Enviar</button>
        </div>
</form>




@endsection