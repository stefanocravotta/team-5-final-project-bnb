@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Il tuo profilo</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
                <div class="card-body">
                    <a href="{{ route('user.messages') }}">Accedi a i tuoi messaggi</a>
                </div>
                <div class="card-body">
                    <a class="navbar-brand" href="{{ route('user.dwellings.index') }}">
                        Appartamenti
                    </a>
                </div>
                <div class="card-body">

                    <a class="navbar-brand" href="{{ route('user.dwellings.create') }}">
                        Aggiungi appartamenti
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
