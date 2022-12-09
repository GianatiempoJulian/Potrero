@extends('layout')


@section('main-content')

<div class="form-hero">
    <h1>Crear Equipo</h1>
    <div class="form-box">
        <div class="general-data-box">
            <form method="POST" action="{{ url('equipos/guardar') }}" enctype="multipart/form-data">
                @csrf
                @if ($errors->any())
                <div class="alert-container">
                    @error('error_msg')
                    <h3 class="alert alert-danger">{{$message}}</h3>
                    @enderror
                </div>
                @endif
                <label for="team_name">Nombre del Equipo</label>
                <input type="text" class="input-box" placeholder="" name="team_name" id="team_name">
                @error('team_name')
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