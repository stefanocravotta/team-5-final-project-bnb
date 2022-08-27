@extends('layouts.app')
@section('content')
    <div>
        @if(session('dwelling_created'))
            <div class="alert alert-success" role="alert">
                {{ session('dwelling_created') }}
            </div>
        @endif

        {{ $dwelling->name }}

    </div>

@endsection
