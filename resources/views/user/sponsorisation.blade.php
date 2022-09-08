@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Sponsorisation</h1>
        <div class="container-fluid d-flex justify-content-between">

            <span>
                @foreach ($sponsorisations as $sponsorisation)
                <p>{{$sponsorisation->name}}</p>
                <p>{{$sponsorisation->price}}</p>
                <p>{{$sponsorisation->time}}</p>
                @endforeach
            </span>
        </div>

        <h2>Sponsorizza il tuo appartamento</h2>
        <form action="{{route('user.sponsorisations-form')}}" method="POST" id="form-sponsorisation">
            @csrf
            <select name="dwelling_id" id="dwellings-select">
                <option  value='0' selected>Scegli il tuo appartamento</option>
                @foreach ($dwellings_user as $dwelling)
                    <option value="{{$dwelling->id}}">{{$dwelling->name}}</option>
                @endforeach
            </select>

            @error('dwelling_id')
                    <p class="error-msg text-danger"> {{ $message }} </p>
            @enderror

            <select name="sponsorisation_id" id="sponsorisation-select">
                <option value='0' selected>Scegli il tuo piano</option>
                @foreach ($sponsorisations as $sponsorisation)
                    <option value="{{$sponsorisation->id}}">{{$sponsorisation->name}}</option>
                @endforeach
            </select>

            @error('sponsorisation_id')
                    <p class="error-msg text-danger"> {{ $message }} </p>
            @enderror

            <button type="submit">Submit</button>


        </form>
    </div>

@endsection
