<!DOCTYPE html>
<html lang="en">
<header>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope&family=Roboto&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/3c1bf8989a.js" crossorigin="anonymous"></script>
    <title>Fulbo</title>
</header>

<body>
    <div class="hero">
        <h1>Crea una cuenta</h1>
        <div class="session-box">
            <div class="left-box">
                <form method="POST" action="{{ url('registro-verificacion') }}">
                    @csrf
                    @if ($errors->any())
                    <div class="alert-container">
                        @error('error_msg')
                        <h3 class="alert alert-danger">{{$message}}</h3>
                        @enderror
                    </div>
                    @endif
                    <input type="text" class="input-box" placeholder="Nombre" name="first_name" id="first_name" value="{{ old('first_name') }}" required>
                    @error('first_name')
                    <p class="error-msg">{{$message}}</p>
                    @enderror
                    <input type="text" class="input-box" placeholder="Apellido" name="last_name" id="last_name" value="{{ old('last_name') }}" required>
                    @error('last_name')
                    <p class="error-msg">{{$message}}</p>
                    @enderror
                    <input type="email" class="input-box" placeholder="Correo" name="email" id="email" value="{{ old('email') }}" required>
                    @error('email')
                    <p class="error-msg">{{$message}}</p>
                    @enderror
                    <input type="password" class="input-box" placeholder="Contraseña" placeholder="" name="password" id="password" required>
                    @error('password')
                    <p class="error-msg">{{$message}}</p>
                    @enderror
                    <input type="checkbox" id='terms' required>
                    <label for="terms">Acepto terminos y condiciones.</label>
                    <button type="submit">Registrarse</button>
                </form>
            </div>
        </div>
        <p class="login-msg">Ya tengo una cuenta <a href="{{ url('ingresar') }}">Ingresar</a></p>
    </div>
</body>

</html>