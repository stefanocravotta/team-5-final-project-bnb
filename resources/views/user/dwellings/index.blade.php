@extends('layouts.app')
@section('content')

        <div class="container">

            @if(session('dwelling_deleted'))
                <div class="alert alert-success" role="alert">
                    {{ session('dwelling_deleted') }}
                </div>
            @endif

            @if(session('not_allowed'))
                <div class="alert alert-danger d-flex justify-content-between" role="alert">
                    <p>{{ session('not_allowed') }}</p>
                    <a href="{{route('user.dwellings.index')}}" class="btn btn-danger">X</a>
                </div>
            @endif

            <h2>I tuoi appartamenti</h2>

        @if (count($dwellings_visible) > 0 )

        <div class="d-flex flex-wrap">

            @foreach ($dwellings_visible as $dwelling)

                {{-- INIZIO CARD --}}

                <div class="card m-2 rounded"  style="width: 22rem;">

                    @if($dwelling->image)

                        <img src="{{ asset('images/'.$dwelling->image) }}" class="card-img-top w-100" alt="{{ $dwelling->name }}">

                    @else

                        <img class="card-img-top w-100" src="{{ asset('images/villa-affitto-italia-ada-1624884100.jpg') }}" alt="default">

                    @endif

                    <div class="card-body">
                        <h3 class="card-title">{{ $dwelling->name }}</h3>
                        <p class="card-text">{{ $dwelling->address }}, {{ $dwelling->city }}</p>
                        <p class="card-text">{{ $dwelling->description }}</p>
                    </div>
                    {{-- <ul class="list-group list-group-flush">
                        <li class="list-group-item">Metri quadrati: {{ $dwelling->dimentions }}</li>
                        <li class="list-group-item">Numero di stanze: {{ $dwelling->rooms }}</li>
                        <li class="list-group-item">Numero di bagni: {{ $dwelling->bathrooms }}</li>
                        <li class="list-group-item">Posti letto: {{ $dwelling->beds }}</li>
                        <li class="list-group-item">Prezzo: {{ $dwelling->price }}&euro; /notte</li>
                    </ul> --}}
                    <div class="card-body">
                        <a href="{{ route('user.dwellings.show', $dwelling)}}" class="btn btn-dark">Vedi dettagli</a>

                        <a href="{{ route('user.dwellings.edit', $dwelling)}}" class="btn btn-primary">Modifica</a>

                        <form class="d-inline" action="{{ route('user.dwellings.destroy', $dwelling) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-public-{{ $dwelling->id }}">
                                Elimina
                            </button>

                            <div class="modal fade" id="modal-public-{{ $dwelling->id }}" tabindex="-1" aria-labelledby="modal-public-label" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modal-public-label">Elimina appartamento</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Sei sicuro di voler eliminare l'appartamento {{ $dwelling->name }}?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>


                {{-- FINE CARD --}}


                {{-- <a href="{{route('user.dwellings.edit', $dwelling)}}"  class="btn btn-primary" >Edit</a>
                <a href="{{route('user.dwellings.show', $dwelling)}}"  class="btn btn-primary" >Show</a>

                <form action="{{ route('user.dwellings.destroy', $dwelling) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">
                        Elimina
                    </button>

                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    ...
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form> --}}

            @endforeach
        </div>

        @else

            <p>Non ci sono appartamenti pubblicati</p>

        @endif

        @if (count($dwellings_pending) > 0)

        <h2>Appartamenti in bozza</h2>

        @foreach ($dwellings_pending as $dwelling)

            {{-- INSERISCI CARD QUI --}}


            {{-- INIZIO CARD --}}

            <div class="card m-2 rounded"  style="width: 22rem;">

                @if($dwelling->image)

                    <img src="{{ asset('images/'.$dwelling->image) }}" class="card-img-top w-100" alt="{{ $dwelling->name }}">

                @else

                    <img class="card-img-top w-100" src="{{ asset('images/villa-affitto-italia-ada-1624884100.jpg') }}" alt="default">

                @endif

                <div class="card-body">
                    <h3 class="card-title">{{ $dwelling->name }}</h3>
                    <p class="card-text">{{ $dwelling->address }}, {{ $dwelling->city }}</p>
                    <p class="card-text">{{ $dwelling->description }}</p>
                </div>
                {{-- <ul class="list-group list-group-flush">
                    <li class="list-group-item">Metri quadrati: {{ $dwelling->dimentions }}</li>
                    <li class="list-group-item">Numero di stanze: {{ $dwelling->rooms }}</li>
                    <li class="list-group-item">Numero di bagni: {{ $dwelling->bathrooms }}</li>
                    <li class="list-group-item">Posti letto: {{ $dwelling->beds }}</li>
                    <li class="list-group-item">Prezzo: {{ $dwelling->price }}&euro; /notte</li>
                </ul> --}}
                <div class="card-body">
                    <a href="{{ route('user.dwellings.show', $dwelling)}}" class="btn btn-dark">Vedi dettagli</a>

                    <a href="{{ route('user.dwellings.edit', $dwelling)}}" class="btn btn-primary">Modifica</a>

                    <form class="d-inline" action="{{ route('user.dwellings.destroy', $dwelling) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-draft-{{ $dwelling->id }}">
                            Elimina
                        </button>

                        <div class="modal fade" id="modal-draft-{{ $dwelling->id }}" tabindex="-1" aria-labelledby="modal-draft-label" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modal-draft-label">Elimina appartamento</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Sei sicuro di voler eliminare l'appartamento {{ $dwelling->name }}?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


            {{-- FINE CARD --}}


            {{-- <a href="{{route('user.dwellings.edit', $dwelling)}}"  class="btn btn-primary" >Edit</a>
            <a href="{{route('user.dwellings.show', $dwelling)}}"  class="btn btn-primary" >Show</a>

            <form action="{{ route('user.dwellings.destroy', $dwelling) }}" method="POST">
            @csrf
            @method('DELETE')

                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-draft-{{ $dwelling->id }}">
                    Elimina
                </button>

                <div class="modal fade" id="modal-draft-{{ $dwelling->id }}" tabindex="-1" aria-labelledby="modal-draft-label" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modal-draft-label">Modal title</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Sei sicuro di voler eliminare l'appartamento {{ $dwelling->name }}?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Delete</button>
                            </div>
                        </div>
                    </div>
                </div> --}}


            </form>
        @endforeach

        @endif




@endsection


