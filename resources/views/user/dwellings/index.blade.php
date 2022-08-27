@extends('layouts.app')
@section('content')
    @if($dwelling)
        <div>
            {{$dwelling->name}}
        </div>
    @endif
@endsection
