@extends('layout')


@section('main-content')

<div class="form-hero">
    <h1>Editar datos de {{auth()->user()->first_name}}</h1>
    <div class="form-box">
        <div class="general-data-box">
            <form method="POST" action="{{ url('usuario/actualizar') }}">
                @csrf
                @if ($errors->any())
                <div class="alert-container">
                    @error('error_msg')
                    <h3 class="alert alert-danger">{{$message}}</h3>
                    @enderror
                </div>
                @endif
                <label for="first_name">Nombre</label>
                <input type="text" class="input-box" placeholder="{{ auth()->user()->first_name }}" name="first_name" id="first_name" value="{{ auth()->user()->first_name  }}">
                @error('first_name')
                <p class="error-msg">{{$message}}</p>
                @enderror
                <label for="last_name">Apellido</label>
                <input type="text" class="input-box" placeholder="{{ auth()->user()->last_name }}" name="last_name" id="last_name" value="{{ auth()->user()->last_name  }}">
                @error('last_name')
                <p class="error-msg">{{$message}}</p>
                @enderror
                <label for="email">Email</label>
                <input type="email" class="input-box" placeholder="{{ auth()->user()->email }}" name="email" id="email" value="{{ auth()->user()->email  }}">
                @error('email')
                <p class="error-msg">{{$message}}</p>
                @enderror
                <label for="password">Contraseña</label>
                <input type="password" class="input-box" name="password" id="password"> 
                @error('password')
                <p class="error-msg">{{$message}}</p>
                @enderror
                <button type="submit">Guardar cambios</button>
            </form>
        </div>
    </div>
</div>
</form>

@endsection