@extends('layouts.app')

@section('content')
<div class="container">

    <div class="wrapper">

{{-- box sinistra --}}
<div class="left-box">
            <p>
                <a href="{{route('home')}}"><i class="fa-solid fa-house"></i> Home</a>
            </p>

            <p>
                <a href="{{route('user.dwellings.index')}}"><i class="fa-solid fa-building"></i> Vai agli appartamenti</a>
            </p>

            <p>
                <a href="{{route('user.messages')}}"><i class="fa-solid fa-envelope"></i> Vai ai tuoi messaggi</a>
            </p>

            <p>
                <a href="{{route('user.dashboard')}}"><i class="fa-solid fa-money-bill"></i> Sponsorizzazioni</a>
            </p>

            <p>
                <a href="{{route('user.dwellings.create')}}"><i class="fa-solid fa-building"></i> Aggiungi un appartamento</a>
            </p>

            <p>
                <a id="navbarDropdown" href="#" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                    <i class="fa-solid fa-person-through-window"></i>
                    Log out
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </p>

                @if (session('success_message'))
                    <div class="alert alert-success">
                        {{ session('success_message') }}
                    </div>
                @endif

                @if (session('error_message'))
                    <div class="alert alert-danger">
                        {{ session('error_message') }}
                    </div>
                @endif

        </div>
        {{-- fine box sinistra --}}

{{-- box destra --}}
        <div class="right-box">
           <div class="dx-wrap">
            <h3 style="color: black">Le tue statistiche:</h3>
            <div class="d-flex justify-content-around mb-5">
                <div class="small-box">
                    <h6>Sessioni totali:</h4>
                    <div class="d-flex justify-content-between">
                        <h5>450</h3> <div><i class="fa-solid fa-chart-simple"></i></div>
                    </div>
                    <hr>
                    <span style="font-size: 12px">Nessun visitatore al momento</span>
                </div>

                <div class="small-box">
                    <h6>Vendite totali:</h4>
                    <div class="d-flex ">
                        Ancora nessuna vendita
                    </div>
                    <hr>
                    <span style="font-size: 12px">Ancora nessun ordine</span>
                </div>

            </div>
            <div class="d-flex justify-content-around">

                <div class="small-box">
                    <h6>L'hardware per il pagamento integrato è ora disponibile!</h4>
                    <div class="d-flex justify-content-between">
                        <span style="font-size: 11px">
                            Accetta i pagamenti "tap and chip" con un lettore di schede completamente integrato e ottieni tariffe basse e costanti
                        </span>
                    </div>
                    <hr>
                    <span class="btn btn-secondary">Visualizza dettagli</span>
                </div>

                <div class="small-box">
                    <h6>Vendi di più con il canale di vendita Messenger! <span class="badge badge-secondary">New</span></h6></h4>
                    <div class="d-flex justify-content-between">
                        <span style="font-size: 11px">
                            Aggiungi il canale Messenger per Facebook e Instagram per avviare chat, condividere prodotti e concludere vendite rapidamente da un solo posto.
                        </span>
                    </div>
                    <hr>
                    <span class="btn btn-secondary">Visualizza dettagli</span>
                </div>
            </div>



            @for ($i=0;$i<1;$i++)

                <div class="dash-card mt-5">
                    <h5>Personalizza le tue comunicazioni con la segmentazione dei clienti</h5>
                    <div>Grazie alla segmentazione è più semplice creare e gestire gruppi di clienti, in modo da recapitare il messaggio giusto alle persone giuste e al momento giusto e dare impulso alle vendite.</div>
                </div>

            @endfor
          </div>
        </div>
    </div>
</div>
@endsection
