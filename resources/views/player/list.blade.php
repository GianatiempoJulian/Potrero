@extends('layout')

@section('main-content')
@if ($errors->any())
<div class="alert-container">
    @error('error_msg')
    <h3 class="alert alert-danger">{{$message}}</h3>
    @enderror
</div>
@endif

<div class="player-grid-pruebas">
    @forelse ($players as $player)
    <div class="player-container-pruebas">
        <img src="{{$player->picture}}" alt="">
        <h3>{{substr($player->first_name,0,1) . ". " . $player->last_name;}}
            @if ($teams[0]->team_id == $player->team_id)
                <p>{{$teams[0]->team_name}}</p>
            @else
                <p>{{$teams[1]->team_name}}</p>
            @endif      
        </h3>
        <div class="dropdown-menu-pruebas">
            <button class="menu-btn-pruebas" id="btn-data-{{$player->player_id}}" onclick="showPlayerData('{{$player->player_id}}')"><i class="fa-solid fa-ellipsis"></i></button>
            <div class="menu-btn-pruebas" id="btn-data"><i class="fa-solid fa-gear"></i>
                <div class="crud-content">
                    <form method="POST" action="{{ url('jugadores/remover') }}">
                        @csrf
                        <input type="hidden" name='player_id' value='{{ $player->player_id }}'>
                        <a class="crud-links-hidden" href="{{ url('jugadores/editar/'.$player->player_id)}}">Editar</a>
                        <button class="crud-links-hidden important-delete-btn" type="submit">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="dropdown-player-info" id="data-{{$player->player_id}}" style="display:none;">
        <a class="player-container-info-data-prueba"><img src="{{ asset('img/pitch.svg') }}" alt="">{{$player->matches}}</a>
        <a class="player-container-info-data-prueba"><img src="{{ asset('img/trophy.svg') }}" alt="">{{$player->matches_win}}</a>
        <a class="player-container-info-data-prueba"><img src="{{ asset('img/ball.svg') }}" alt="">{{$player->goals}}</a>
        <a class="player-container-info-data-prueba"><img src="{{ asset('img/avg.svg') }}" alt="">{{ ($player->matches > 0)?number_format($player->goals/$player->matches,2):  '0' }}</a>
    </div>
    @empty
    @endforelse
</div>

@endsection