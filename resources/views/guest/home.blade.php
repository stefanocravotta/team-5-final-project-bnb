<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

        <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.1.2-public-preview.15/services/services-web.min.js"></script>
        <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/plugins/SearchBox/3.1.3-public-preview.0/SearchBox-web.js"></script>

        <link rel='stylesheet' type='text/css' href='https://api.tomtom.com/maps-sdk-for-web/cdn/plugins/SearchBox/3.1.3-public-preview.0/SearchBox.css'/>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <link rel="stylesheet" href="{{ asset('css/frontend/style.css') }}">

        <script src="{{ asset('js/frontend/frontend.js') }}" defer></script>
    </head>
    <body>
        <div class="main-wrap">
            <header class="container-fluid d-flex justify-content-between w-75">
                <div>
                    <a href="{{route('home')}}">Home</a>
                </div>
                <a href="{{route('home')}}">
                    <img class="logo" src="{{asset('images/newlogo.png')}}" alt="">
                </a>

                <div class="d-flex">
                    <div class="">
                        @if (Route::has('login'))
                            <div class="top-right links">
                                @auth
                                    <a href="{{ route('user.dashboard') }}"><i class="fa-regular fa-user"></i></a>
                                @else
                                    <a href="{{ route('login') }}">Login</a>

                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}">Register</a>
                                    @endif
                                @endauth
                            </div>
                        @endif
                    </div>
                </div>
            </header>
        </div>

        <div id="app"></div>
    </body>
</html>
<style>
    a{
        margin-left: 20px;
    }
</style>
<script >


