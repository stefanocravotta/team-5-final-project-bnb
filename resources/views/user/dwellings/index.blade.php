@extends('layouts.app')
@section('content')

        <div class="container">

            @if(session('dwelling_deleted'))
                <div class="alert alert-success" role="alert">
                    {{ session('dwelling_deleted') }}
                </div>
            @endif

            @foreach ($dwellings as $dwelling)

                <p>{{$dwelling->name}}</p>

                <a href="{{route('user.dwellings.edit', $dwelling)}}"  class="btn btn-primary" >Edit</a>
                <a href="{{route('user.dwellings.show', $dwelling)}}"  class="btn btn-primary" >Show</a>

                <form action="{{ route('user.dwellings.destroy', $dwelling) }}" method="POST">
                @csrf
                @method('DELETE')
                    <input type="submit" value="Delete">
                </form>

            @endforeach
        </div>

@endsection
