@extends('layouts.app')

@section('content')
<div class="container">

    <div class="wrapper">

    {{-- box sinistra --}}
        <div class="left-box">
            <p class="d-flex align-items-center dashboard-link">
                <i class="fa-solid fa-house fa-2x mr-3 w-25 text-center"></i>
                <a href="{{route('home')}}">Home</a>
            </p>

            <p class="d-flex align-items-center dashboard-link">
                <i class="fa-solid fa-building fa-2x mr-3 w-25 text-center"></i>
                <a href="{{route('user.dwellings.index')}}"> Vai agli appartamenti</a>
            </p>

            <p class="d-flex align-items-center dashboard-link">
                <i class="fa-solid fa-envelope fa-2x mr-3 w-25 text-center"></i>
                <a href="{{route('user.messages')}}"> Vai ai tuoi messaggi</a>
            </p>

            <p class="d-flex align-items-center dashboard-link">
                <i class="fa-solid fa-money-bill fa-2x mr-3 w-25 text-center"></i>
                <a href="{{route('user.sponsorisations')}}"> Sponsorizzazioni</a>
            </p>

            <p class="d-flex align-items-center dashboard-link">
                <i class="fa-solid fa-building fa-2x mr-3 w-25 text-center"></i>
                <a href="{{route('user.dwellings.create')}}"> Aggiungi un appartamento</a>
            </p>

            <p class="d-flex align-items-center dashboard-link">
                <i class="fa-solid fa-person-through-window fa-2x mr-3 w-25 text-center"></i>
                <a id="navbarDropdown" href="#" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                    Log out
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </p>
            <p class="back">
                <a href="{{url()->previous()}}" class="btn btn-secondary"><- Torna alla pagina precedente </a>
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
                    <div class="d-flex justify-content-around mb-4">
                        <div class="small-box">
                            <h4>Sessioni totali:</h4>
                            <div class="first d-flex justify-content-between">
                                <h2 class="sell-data">450</h2>
                                <div class="c-cont">
                                    <div class="c-wrap">
                                        <div class="c-1"></div>
                                    </div>
                                    <div class="c-2"></div>
                                    <div class="c-3"></div>
                                </div>
                            </div>
                            <div class="row-wrap d-flex">
                                <div class="c-row"></div>
                            </div>
                            <div>

                            </div>
                            <span style="font-size: 18px; margin: 0 auto;">9 visitatori nell'ultima ora</span>
                        </div>

                        <div class="small-box">
                            <h4>Vendite totali:</h4>
                            <div class="d-flex justify-content-center">
                                <h2 class="sell-data">16</h2>
                            </div>
                            <div class="row-wrap d-flex">
                                <div class="c-row"></div>
                            </div>
                            <span style="font-size: 18px; margin: 0 auto;">7 ordini in sospeso</span>
                        </div>

                    </div>
                    <div class="d-flex justify-content-around">

                        <div class="small-box">
                            <div class="head">
                                <img class="sm-img" src="images/pos.avif" alt="">
                                <h5>L'hardware per il pagamento integrato è ora disponibile!</h5>
                            </div>
                            <div class="d-flex justify-content-between my-2">
                                <span style="font-size: 14px">
                                    Accetta i pagamenti "tap and chip" con un lettore di schede completamente integrato e ottieni tariffe basse e costanti
                                </span>
                            </div>
                            <div class="row-wrap d-flex">
                                <div class="c-row"></div>
                            </div>
                            <span class="btn btn-secondary">Visualizza dettagli</span>
                        </div>

                        <div class="small-box">
                            <div class="head">
                                <img src="images/pngwing.com.png" class="sm-img" id="ms-img" alt="">
                                <h5>Vendi di più con il canale di vendita Messenger! <span class="badge badge-secondary">New</span></h5>
                            </div>
                            <div class="d-flex justify-content-between my-2">
                                <span style="font-size: 12px">
                                    Aggiungi il canale Messenger per Facebook e Instagram per avviare chat, condividere prodotti e concludere vendite rapidamente da un solo posto.
                                </span>
                            </div>
                            <div class="row-wrap d-flex">
                                <div class="c-row"></div>
                            </div>
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
