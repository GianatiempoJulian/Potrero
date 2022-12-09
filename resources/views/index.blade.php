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
    <title>Fulbo</title>
</header>

<body>
    <div class="main-container">
        <div class="main-content">
            <img class="page-logo index-logo" src="{{asset('img/logo-bk.png')}}" alt="" >
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. <br>
                Qui ipsum aperiam corrupti non tempora ducimus libero adipisci laboriosam fugiat totam.
            </p>
            <div class="main-button-container">
                <button type="button"><a href="{{ url('registro') }}">Ingresar</a></button>
                <button type="button"><a href="#">Mas sobre nosotros</a></button>
            </div>
            <div class="main-social-container">
                <ul>
                    <li>
                       <a href="https://gianatiempo.000webhostapp.com/"><img src="{{asset('img/home.png')}}" alt="page-logo"></a>
                    </li>
                    <li>
                        <a href="https://github.com/GianatiempoJulian"><img src="{{asset('img/github.png')}}" alt="github-logo"></a>
                    </li>
                    <li>
                        <a href="https://www.linkedin.com/in/jgianatiempo/"><img src="{{asset('img/linkedin.png')}}" alt="linkedin-logo"></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</body>

</html>