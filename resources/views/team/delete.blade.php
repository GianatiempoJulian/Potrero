@extends('layout')


@section('main-content')

<div class="form-hero">
    <h1>Eliminar Equipo</h1>
    <div class="form-box">
        <div class="general-data-box">
            <form method="POST" action="{{ url('equipos/remover') }}">
                @csrf
                @if ($errors->any())
                <div class="alert-container">
                    @error('error_msg')
                    <h3 class="alert alert-danger">{{$message}}</h3>
                    @enderror
                </div>
                @endif
                <label for="">Equipo</label>
                <select  class="input-box" name="team_id" id="team_id">
                    @foreach ($teams as $team)
                    <option value="{{ $team->team_id }}">{{ $team->team_name }}</option>
                    @endforeach   
                </select>
                @error('team_name')
                    <p class="error-msg">{{$message}}</p>
                @enderror
                <button type="submit">Eliminar</button>
            </form>
        </div>
    </div>
</div>
</form>

@endsection