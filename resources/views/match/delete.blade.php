@extends('layout')

@section('main-content')

<h1 class="section-name" style="margin:20px 0px">Eliminar Partido</h1>
@if ($errors->any())
<div class="alert-container">
    @error('error_msg')
    <h3 class="alert alert-danger">{{$message}}</h3>
    @enderror
</div>
@endif
<div class="matches-grid">
    <form method="POST" action="{{ url('partidos/remover') }}">
        @csrf
        <div class="match-data-container">
            <p class="match-data-title">Fecha</p>
            <p class="match-data-title">Equipo</p>
            <p class="match-data-title">Goles</p>
            <p class="match-data-title">Equipo</p>
            <p class="match-data-title">Goles</p>
            <p class="match-data-title">Goleador</p>
        </div>

        @for ($x = count($matches) - 1 ; $x >= 0; $x--)
        <div class="match-container">

            <p>{{$matches[$x]['created_at']->format('d-m-y')}}</p>
            <p class="team1">{{$team1_name}}</p>
            <p id="team1-result">{{$matches[$x]['team1_goals']}}</p>
            <p class="team2">{{$team2_name}}</p>
            <p id="team2-result">{{$matches[$x]['team2_goals']}}</p>
            <p>{{$matches[$x]['max_scorer_name']}} ({{$matches[$x]['max_scorer_amount']}})</p>
            <input type="hidden" name='match_id' value='{{ $matches[$x]["match_id"] }}'>
        </div>
        <button type="submit" class="btn-small btn-delete-match-custom">Eliminar</button>
        @endfor
    </form>
</div>

@endsection