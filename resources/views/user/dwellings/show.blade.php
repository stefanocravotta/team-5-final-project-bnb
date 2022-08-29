@extends('layouts.app')
@section('content')
    <div class="container">
        @if(session('dwelling_created'))
            <div class="alert alert-success" role="alert">
                {{ session('dwelling_created') }}
            </div>
        @endif

        {{-- <h2>{{ $dwelling->name }}</h2> --}}

        <div class="card">
            @if($dwelling->image)

                <img src="{{ asset('images/'.$dwelling->image) }}" class="card-img-top" alt="{{ $dwelling }}">

            @else

                <img src="{{ asset('images/villa-affitto-italia-ada-1624884100.jpg') }}" alt="default">

            @endif

            <div class="card-body">
                <h5 class="card-title">{{ $dwelling->name }}</h5>
                <p class="card-text">{{ $dwelling->address }}, {{ $dwelling->city }}</p>
                <p class="card-text">{{ $dwelling->description }}</p>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Metri quadrati: {{ $dwelling->dimentions }}</li>
                <li class="list-group-item">Numero di stanze: {{ $dwelling->rooms }}</li>
                <li class="list-group-item">Numero di bagni: {{ $dwelling->bathrooms }}</li>
                <li class="list-group-item">Posti letto: {{ $dwelling->beds }}</li>
                <li class="list-group-item">Prezzo: {{ $dwelling->price }}&euro; /notte</li>
            </ul>
            <div class="card-body">
                <a href="{{ route('user.dwellings.index')}}" class="btn btn-dark">&lt;&lt; Torna ai tuoi appartamenti</a>

                <a href="{{ route('user.dwellings.edit', $dwelling)}}" class="btn btn-primary">Edit</a>

                <form class="d-inline" action="{{ route('user.dwellings.destroy', $dwelling) }}" method="POST" onsubmit="return confirm('Sei sicuro di voler eliminare l\'appartamento {{ $dwelling->name }}?')">
                    @csrf
                    @method('DELETE')
                        <input class="btn btn-danger" type="submit" value="Delete">
                </form>
            </div>
        </div>


    </div>

@endsection
