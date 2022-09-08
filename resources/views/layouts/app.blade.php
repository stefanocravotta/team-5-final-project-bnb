<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/backend/backend.js') }}" defer></script>

    {{-- JQUERY --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js%22%3E"></script>

    {{--FONT AWESOME CDN--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.1.2-public-preview.15/services/services-web.min.js"></script>
    <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/plugins/SearchBox/3.1.3-public-preview.0/SearchBox-web.js"></script>

    <script>(function(){ window.SS = window.SS || {}; SS.Require = function (callback){ if (typeof callback === 'function') { if (window.SS && SS.EventTrack) { callback(); } else { var siteSpect = document.getElementById('siteSpectLibraries'); var head = document.getElementsByTagName('head')[0]; if (siteSpect === null && typeof head !== 'undefined') { siteSpect = document.createElement('script'); siteSpect.type = 'text/javascript'; siteSpect.src = '/__ssobj/core.js+ssdomvar.js+generic-adapter.js';siteSpect.async = true; siteSpect.id = 'siteSpectLibraries'; head.appendChild(siteSpect); } if (window.addEventListener){ siteSpect.addEventListener('load', callback, false); } else { siteSpect.attachEvent('onload', callback, false); } } } };})(); </script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/backend/style.css') }}" rel="stylesheet">

    <link rel='stylesheet' type='text/css' href='https://api.tomtom.com/maps-sdk-for-web/cdn/plugins/SearchBox/3.1.3-public-preview.0/SearchBox.css'/>
    <link rel='stylesheet' type='text/css' href='https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.20.0/maps/maps.css'>

    <style>
        #map {
            height: 70vh;
            width: 70vw;
        }
    </style>

</head>


<body>
    <div class="main-wrap">
        <header class="container-fluid d-flex justify-content-between w-75">
            <div>
                <a href="{{route('home')}}">Home</a>
            </div>
            <div >
                <a href="{{route('home')}}">
                    <img class="logo" src="{{asset('images/logononame.png')}}" alt="">
                </a>
            </div>

            <div class="d-flex">
                <div class="">
                    @if (Route::has('login'))
                        <div class="top-right links">
                            @auth
                                <a href="{{ route('user.dashboard') }}"><i class="fa-regular fa-user"></i></a>
                            @else
                                <a href="{{ route('login') }}">Accedi</a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}">Registrati</a>
                                @endif
                            @endauth
                        </div>
                    @endif
                </div>
            </div>
        </header>
    </div>

        <main>
            @yield('content')
        </main>
    </div>
</body>
</html>
