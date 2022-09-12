@extends('layouts.app')

@section('content')
<div class="container">

    <div class="wrapper">

    {{-- box sinistra --}}
        <div class="left-box">
            <a href="{{route('home')}}" class="d-flex align-items-center dashboard-link">
                <i class="fa-solid fa-house fa-2x d-none d-md-inline mr-3 w-25 text-center"></i>
                <span>Home</span>
            </a>

            <a href="{{route('user.dwellings.index')}}" class="d-flex align-items-center dashboard-link">
                <i class="fa-solid fa-building fa-2x d-none d-md-inline mr-3 w-25 text-center"></i>
                <span> Vai agli appartamenti</span>
            </a>

            <a href="{{route('user.messages')}}" class="d-flex align-items-center dashboard-link">
                <i class="fa-solid fa-envelope fa-2x d-none d-md-inline mr-3 w-25 text-center"></i>
                <span> Vai ai tuoi messaggi</span>
            </a>

            <a href="{{route('user.sponsorisations')}}" class="d-flex align-items-center dashboard-link">
                <i class="fa-solid fa-money-bill fa-2x d-none d-md-inline mr-3 w-25 text-center"></i>
                <span> Sponsorizzazioni</span>
            </a>

            <a href="{{route('user.dwellings.create')}}" class="d-flex align-items-center dashboard-link">
                <i class="fa-solid fa-building fa-2x d-none d-md-inline mr-3 w-25 text-center"></i>
                <span> Aggiungi un appartamento</span>
            </a>

            <a id="navbarDropdown" href="#" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();" class="d-flex align-items-center dashboard-link">
                <i class="fa-solid fa-person-through-window fa-2x d-none d-md-inline mr-3 w-25 text-center"></i>
                <span>
                    Log out
                </span>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </a>
            <p class="back">
                <a href="{{url()->previous()}}" class="btn-chiudi"><i class="fa-solid fa-arrow-left"></i> Torna ai tuoi appartamenti</a>
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

                <div class="container-fluid">
                    <div class="row justify-content-around mb-4">

                        <div class="col-12 col-md-6">
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
                        </div>

                        <div class="col-12 col-md-6">
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


                    </div>
                </div>

                <div class="container-fluid">
                    <div class="row justify-content-around">

                        <div class="col-12 col-md-6">
                            <div class="small-box">
                                <div class="head">
                                    <img class="sm-img" src="images/pos.avif" alt="">
                                    <h5>Sponsorizza uno o pi&uacute;; appartamenti!</h5>
                                </div>
                                <div class="d-flex justify-content-between my-2">
                                    <span style="font-size: 14px">
                                        Sponsorizzando uno o pi&uacute; appartamenti, i clienti potranno visualizzarli nella home tragli "Appartamenti consigliati"
                                    </span>
                                </div>
                                <div class="row-wrap d-flex">
                                    <div class="c-row"></div>
                                </div>
                                <a class="btn btn-secondary" href="{{route('user.sponsorisations')}}">Visualizza i pacchetti</a>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="small-box">
                                <div class="head">
                                    <img src="images/pngwing.com.png" class="sm-img" id="ms-img" alt="">
                                    <h5>Ora gli utenti possono contattarti! <span class="badge badge-secondary">New</span></h5>
                                </div>
                                <div class="d-flex justify-content-between my-2">
                                    <span style="font-size: 12px">
                                        Controlla se sei stato/a contattato/a, troverai l'email dell'utente alla quale potrairispondere
                                    </span>
                                </div>
                                <div class="row-wrap d-flex">
                                    <div class="c-row"></div>
                                </div>
                                <a class="btn btn-secondary" href="{{route('user.messages')}}">Controlla i tuoi messaggi</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
