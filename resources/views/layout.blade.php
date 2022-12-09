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


    <!-- NAV -->
    <nav>
        @guest
        @else
        <ul class="dropdown">
            <li class="dropdown-menu logo-styles">
                <picture>
                    <source media="(min-width: 800px)" srcset="{{asset('img/logo.png')}}">
                    <source media="(max-width: 400px)" srcset="{{asset('img/logo-sm.png')}}">
                    <img class="page-logo" src="{{asset('img/logo.png')}}" alt="">
                </picture>
            </li>
            <li class="dropdown-menu">
                <button class="menu-btn special-btn"><i class="fa-solid fa-user"></i>{{ auth()->user()->first_name }}</button>
                <div class="menu-content">
                    <a class="links-hidden" href="#">Perfil</a>
                    <a class="links-hidden" href="{{route('usuario/editar')}}">Editar datos</a>
                    <a class="links-hidden" href="{{route('cerrar-sesion')}}">Cerrar sesión</a>
                </div>
            </li>
            <li class="dropdown-menu">
                <button class="menu-btn"><i class="fa-solid fa-people-group"></i>Equipos</button>
                <div class="menu-content">
                    <a class="links-hidden" href="{{route('equipos')}}">Lista</a>
                    <a class="links-hidden" href="{{route('equipos/nuevo')}}">Crear</a>
                    <a class="links-hidden" href="{{route('equipos/eliminar')}}">Eliminar</a>
                    <a class="links-hidden" href="{{route('equipos/editar')}}">Editar</a>
                </div>
            </li>
            <li class="dropdown-menu">
                <button class="menu-btn"><i class="fa-solid fa-person-running"></i>Jugadores</button>
                <div class="menu-content">
                    <a class="links-hidden" href="{{route('jugadores')}}">Lista</a>
                    <a class="links-hidden" href="{{route('jugadores/nuevo')}}">Crear</a>
                </div>
            </li>
            <li class="dropdown-menu">
                <button class="menu-btn"><i class="fa-solid fa-futbol"></i>Partidos</button>
                <div class="menu-content">
                    <a class="links-hidden" href="{{route('historial')}}">Historial</a>
                    <a class="links-hidden" href="{{route('partidos/nuevo')}}">Cargar</a>
                    <a class="links-hidden" href="{{route('partidos/eliminar')}}">Eliminar</a>
                    <a class="links-hidden" href="{{route('partidos/ultimo')}}">Ultimo Partido</a>

                </div>
            </li>
        </ul>

        @endguest
    </nav>

    <main>
        <div class="grid">
            @yield('main-content')
        </div>

    </main>



    <script src="{{ asset('js/script.js') }}" defer></script>
</body>
<footer class="main-footer">
    <ul>
        <li>
            <a class="footer-link" href="https://github.com/GianatiempoJulian">Github</a>
        </li>
        <li>
            <a class="footer-link" href="https://www.linkedin.com/in/jgianatiempo/">Linkedin</a>
        </li>
        <li>
            <a class="footer-link" href="https://gianatiempo.000webhostapp.com/">Mi página</a>
        </li>
    </ul>
    <p class="footer-text">© 2022 Julian Gianatiempo</p>
</footer>

</html>