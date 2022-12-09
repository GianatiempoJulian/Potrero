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
        <h1>Ingresar</h1>
        <div class="session-box">
            <div class="login-box">
                <form method="POST" action="{{ url('ingresar-verificacion') }}">
                    @csrf
                    @if ($errors->any())
                    <div class="alert-container">
                        @error('error_msg')
                        <h3 class="alert alert-danger">{{$message}}</h3>
                        @enderror
                    </div>
                    @endif
                    <input type="email" class="input-box" placeholder="Correo" name="email" id="email" value="{{ old('email') }}" required>
                    @error('email')
                    <p class="error-msg">{{$message}}</p>
                    @enderror
                    <input type="password" class="input-box" placeholder="Contraseña" placeholder="" name="password" id="password" required>
                    @error('password')
                    <p class="error-msg">{{$message}}</p>
                    @enderror
                    <button type="submit">Ingresar</button>
                </form>
            </div>
        </div>
        <p class="login-msg">¿No tienes cuenta? <a href="{{ url('registro') }}">Registrarme</a></p>
    </div>
</body>

</html>