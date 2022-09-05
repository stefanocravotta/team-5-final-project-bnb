@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Il tuo profilo</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
                <div class="card-body">
                    <a href="{{ route('user.messages') }}">Accedi a i tuoi messaggi</a>
                </div>
                <div class="card-body">
                    <a class="navbar-brand" href="{{ route('user.dwellings.index') }}">
                        Appartamenti
                    </a>
                </div>
                <div class="card-body">

                    <a class="navbar-brand" href="{{ route('user.dwellings.create') }}">
                        Aggiungi appartamenti
                    </a>
                </div>
            </div>
        </div>
<<<<<<< Updated upstream
=======
    </div> --}}
    <div class="wrapper">

{{-- box sinistra --}}
<div class="left-box">
            <p><a href="{{route('home')}}"><i class="fa-solid fa-house"></i> Home</a></p>
            <hr>
            <p><a href="{{route('user.dwellings.index')}}"><i class="fa-solid fa-building"></i> Vai agli appartamenti</a></p>
            <hr>
            <p><a href="{{route('user.messages')}}"><i class="fa-solid fa-envelope"></i> Vai ai tuoi messaggi</a></p>
            <hr>
            <p><a href="{{route('user.dashboard')}}"><i class="fa-solid fa-money-bill"></i> Sponsorizzazioni</a></p>
            <hr>
            <p><a href="{{route('user.dwellings.create')}}"><i class="fa-solid fa-building"></i> Aggiungi un appartamento</a></p>
            <hr>
            @for ($i=0;$i<10;$i++)
                <p><a href="{{route('user.dashboard')}}">Altri link</a></p>
                <hr>
            @endfor
        </div>
        {{-- fine box sinistra --}}

{{-- box destra --}}
        <div class="right-box">
           <div class="dx-wrap">
            <h3>Le tue statistiche:</h3>
            <div class="d-flex justify-content-around mb-5">
                <div class="small-box"></div>
                <div class="small-box"></div>
            </div>
            <div class="d-flex justify-content-around">
                <div class="small-box"></div>
                <div class="small-box"></div>
            </div>



            @for ($i=0;$i<3;$i++)

                <div class="dash-card mt-5">
                    <h5>Personalizza le tue comunicazioni con la segmentazione dei clienti</h5>
                    <div>Grazie alla segmentazione è più semplice creare e gestire gruppi di clienti, in modo da recapitare il messaggio giusto alle persone giuste e al momento giusto e dare impulso alle vendite.</div>
                </div>

            @endfor
          </div>
        </div>
>>>>>>> Stashed changes
    </div>
</div>
@endsection
