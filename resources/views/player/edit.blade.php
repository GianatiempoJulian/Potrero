@extends('layout')


@section('main-content')

<div class="form-hero">
        <div class="form-box">
                <div class="general-data-box">
                        <form method="POST" action="{{ url('jugadores/actualizar') }}">
                                @csrf
                                @if ($errors->any())
                                <div class="alert-container">
                                        @error('error_msg')
                                        <h3 class="alert alert-danger">{{$message}}</h3>
                                        @enderror
                                </div>
                                @endif
                                <img src="{{$player->picture}}" alt="">
                                <label for="first_name">Nombre</label>
                                <input type="text" class="input-box" placeholder="{{ $player->first_name }}" name="first_name" id="first_name" value="{{ $player->first_name  }}">

                                <label for="last_name">Apellido</label>
                                <input type="text" class="input-box" placeholder="{{ $player->last_name }}" name="last_name" id="last_name" value="{{ $player->last_name  }}">

                                <label for="" style="width: 100%;display:block;">Estadisticas</label>
                                <input type="number" class="input-box" style="width: 32%; display:inline;" placeholder="Partidos: {{ $player->matches }}" name="matches" id="matches">
                                <input type="number" class="input-box" style="width: 32%; display:inline;" placeholder="Ganados: {{ $player->matches_win }}"" name=" matches_win" id="matches_win">
                                <input type="number" class="input-box" style="width: 32%; display:inline;" placeholder="Goles: {{ $player->goals }}"" name=" goals" id="goals">

                                <label for="">Equipo</label>
                                <select class="input-box" name="team_id" id="team_id">
                                        @foreach ($teams as $team)
                                        <option value="{{ $team->team_id }}">{{ $team->team_name }}</option>
                                        @endforeach
                                </select>

                                <label for="plays_today">¿Jugó hoy?</label>
                                <label for="">Si</label>
                                <input type="radio" name="plays_today" value="1" required>
                                <label for="">No</label>
                                <input type="radio" name="plays_today" value="0" required>
                                @error('plays_today')
                                        <p class="error-msg">{{$message}}</p>
                                @enderror
                                <input type="hidden" name='player_id' value='{{ $player->player_id }}'>
                                <button type="submit">Guardar cambios</button>
                        </form>
                </div>
        </div>
</div>
</form>

@endsection