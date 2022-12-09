@extends('layout')


@section('main-content')

<div class="form-hero">
    <h1>Crear Jugador</h1>
    <div class="form-box">
        <div class="general-data-box">
            <form method="POST" action="{{ url('jugadores/guardar') }}" enctype="multipart/form-data">
                @csrf
                @if ($errors->any())
                <div class="alert-container">
                    @error('error_msg')
                    <h3 class="alert alert-danger">{{$message}}</h3>
                    @enderror
                </div>
                @endif
                <label for="">Equipo</label>
                <select class="input-box" name="team_id" id="team_id">
                    @foreach ($teams as $team)
                    <option value="{{ $team->team_id }}">{{ $team->team_name }}</option>
                    @endforeach
                </select>
                <label for="first_name">Nombre</label>
                <input type="text" class="input-box" placeholder="" name="first_name" id="first_name">
                @error('first_name')
                <p class="error-msg">{{$message}}</p>
                @enderror
                <label for="last_name">Apellido</label>
                <input type="text" class="input-box" placeholder="" name="last_name" id="last_name">
                @error('last_name')
                <p class="error-msg">{{$message}}</p>
                @enderror
                <label for="picture">Foto</label>
                <input type="file" class="input-box" name="picture" id="picture" accept="image/*">
                @error('picture')
                <p class="error-msg">{{$message}}</p>
                @enderror
                <button type="submit">Crear</button>
            </form>
        </div>
    </div>
</div>
</form>

@endsection