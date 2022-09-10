@extends('layouts.app')
@section('content')

        <div class="container">

            <div class="container-fluid">

                @if(session('dwelling_deleted'))
                    <div class="alert alert-danger d-flex justify-content-between" role="alert">
                        <p>{{ session('dwelling_deleted') }}</p>
                        <a href="{{route('user.dwellings.index')}}" class="btn btn-danger">X</a>
                    </div>
                @endif

                @if(session('not_allowed'))
                    <div class="alert alert-danger d-flex justify-content-between" role="alert">
                        <p>{{ session('not_allowed') }}</p>
                        <a href="{{route('user.dwellings.index')}}" class="btn btn-danger">X</a>
                    </div>
                @endif

                <div class="px-2 row">
                    <h2 class="col-12 col-md-6">I tuoi appartamenti</h2>

                    <div class="d-flex align-items-center col-12 col-md-6">
                        <h4 class="d-inline">Aggiungi appartamento</h4>
                        <i class="fa-solid fa-arrow-right ml-2 pb-1"></i>
                        <a class="create_link ml-4" href="{{ route('user.dwellings.create') }}">
                            <i class="fa-solid fa-plus"></i>
                        </a>
                    </div>
                </div>

                    @if (count($dwellings_visible) > 0 )

                    <div class="row">


                        @foreach ($dwellings_visible as $dwelling)

                        {{-- INIZIO CARD --}}

                        <div class="card-custom my-2 col-12 col-md-6">
                            <div class="card-head h-75">

                                <div class="card-image h-75" style="background-image: url({{ $dwelling->image ? asset('images/'.$dwelling->image) : asset('images/placeholder/1.png') }}) ">

                                    <div class="layer d-flex justify-content-center align-items-center">
                                        <h3 class="span-view text-white">Vedi la proprietà
                                        </h3>
                                        <i class="fa-solid fa-arrow-right ml-2 pb-1"></i>
                                    </div>
                                </div>
                                <div class="py-3 h-25">
                                    <h3 class="card-title">{{ $dwelling->name }}</h3>
                                    <p class="card-text">{{ $dwelling->address }}</p>
                                    <a class="show-link" href="{{ route('user.dwellings.show', $dwelling)}}"></a>
                                </div>
                            </div>



                            <div class="py-3 h-25">

                                <a href="{{ route('user.dwellings.edit', $dwelling)}}" class="btn-pubblica">Modifica</a>

                                <form class="d-inline" action="{{ route('user.dwellings.destroy', $dwelling) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn-bozza" data-toggle="modal" data-target="#modal-public-{{ $dwelling->id }}">
                                        Elimina
                                    </button>

                                    <div class="modal fade" id="modal-public-{{ $dwelling->id }}" tabindex="-1" aria-labelledby="modal-public-label" aria-hidden="true">
                                        <div class="modal-dialog mb-modalCont">
                                            <div class="modal-content mb-modalCont">
                                                <div class="modal-header mb-modalCont">
                                                    <h5 class="modal-title" id="modal-public-label">Elimina appartamento</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Sei sicuro di voler eliminare l'appartamento {{ $dwelling->name }}?</p>
                                                </div>
                                                <div class="modal-footer mb-modalFoot">
                                                    <button type="button" class="btn-chiudi" data-dismiss="modal">Chiudi</button>
                                                    <button type="submit" class="btn-inserisci">Elimina</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <span class="line"></span>
                            </div>
                        </div>

                        {{-- FINE CARD --}}

                        @endforeach
                    </div>

                        @else

                            <p>Non ci sono appartamenti pubblicati</p>

                        @endif

                        @if (count($dwellings_pending) > 0)

                    <div>
                        <h2>Appartamenti in bozza</h2>
                    </div>

                    <div class="row">

                        @foreach ($dwellings_pending as $dwelling)


                        {{-- INIZIO CARD --}}


                        <div class="card-custom my-2 col-12 col-md-6">
                            <div class="card-head">

                                <div class="card-image">
                                    @if($dwelling->image)

                                    <img src="{{ asset('images/'.$dwelling->image) }}" class="img-fluid w-100" alt="{{ $dwelling->name }}">

                                    @else

                                    <img class="img-fluid w-100" src="{{ asset('images/villa-affitto-italia-ada-1624884100.jpg') }}" alt="default">

                                    @endif
                                    <div class="layer d-flex justify-content-center align-items-center">
                                        <h3 class="span-view text-white">View project
                                        </h3>
                                        <i class="fa-solid fa-arrow-right ml-2 pb-1"></i>
                                    </div>
                                </div>

                                <div class="py-3">
                                    <h3 class="card-title">{{ $dwelling->name }}</h3>
                                    <p class="card-text">{{ $dwelling->address }}</p>
                                    <a class="show-link" href="{{ route('user.dwellings.show', $dwelling)}}"></a>
                                </div>
                            </div>

                            <div class="py-3">


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
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Chiudi</button>
                                                    <button type="submit" class="btn btn-danger">Elimina</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <span class="line"></span>
                            </div>
                        </div>

                        {{-- FINE CARD --}}

                        @endforeach
                    </div>

                    @endif

            </div>

        </div>

@endsection


