@extends('layouts.app')
@section('content')
    @if($dwelling)
        <div class="container">
            <p>{{$dwelling->name}}</p>
            <a href="{{route('user.dwellings.edit', $dwelling)}}"  class="btn btn-primary" >Edit</a>
        </div>
    @endif
@endsection
