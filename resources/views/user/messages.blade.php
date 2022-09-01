@extends('layouts.app')

@section('content')
<div class="container">
    <h2>I tuoi messaggi</h2>
    @foreach ($dwellings as $dwelling)
    @if (count($dwelling->messages) > 0)
    <h2>{{$dwelling->name}}</h2>
        @foreach ($dwelling->messages as $message)
            <div class="card my-3">
                <h3>{{$message->sender_email}}</h3>
                <h4>{{$message->created_at}}</h4>
                <h3>{{$message->text}}</h3>
            </div>

        @endforeach

    @endif
    @endforeach
</div>
@endsection
