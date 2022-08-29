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

        @foreach ($dwellings_visible as $dwelling)
            <p>{{$dwelling->name}}</p>

            <a href="{{route('user.dwellings.edit', $dwelling)}}"  class="btn btn-primary" >Edit</a>
            <a href="{{route('user.dwellings.show', $dwelling)}}"  class="btn btn-primary" >Show</a>

            <form action="{{ route('user.dwellings.destroy', $dwelling) }}" method="POST">
            @csrf
            @method('DELETE')
                <input type="submit" value="Delete">
            </form>
        @endforeach

        @else

            <p>Non ci sono appartamenti pubblicati</p>

        @endif

        @if (count($dwellings_pending) > 0)

        <h2>Appartamenti in bozza</h2>

        @foreach ($dwellings_pending as $dwelling)
            <p>{{$dwelling->name}}</p>

            <a href="{{route('user.dwellings.edit', $dwelling)}}"  class="btn btn-primary" >Edit</a>
            <a href="{{route('user.dwellings.show', $dwelling)}}"  class="btn btn-primary" >Show</a>

            <form action="{{ route('user.dwellings.destroy', $dwelling) }}" method="POST">
            @csrf
            @method('DELETE')
                <input type="submit" value="Delete">
            </form>
        @endforeach

        @endif





@endsection
