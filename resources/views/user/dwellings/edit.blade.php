@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Modifica il tuo appartamento</h2>
    <form action="{{ route('user.dwellings.update',$dwelling) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
                <label for="name">Nome della struttura</label>
                <input class="form-control" type="text" name="name"
                value="{{ !$errors->any() ? $dwelling->name : old('name') }}"
                class="form-control @error('name') is-invalid @enderror">

                @error('name')
                    <p class="error-msg text-danger"> {{ $message }} </p>
                @enderror
        </div>

            <div class="mb-3">
                <label for="category">Tipo di struttura</label>
                <select class="form-control" name="category">
                    @foreach ($categories as $category)

                        <option value="{{$category->id}}"
                        @if (!$errors->any() && $category->id == $dwelling->category)
                            selected
                        @elseif ($errors->any() && $category->id == old('category'))
                            selected
                        @endif>{{ $category->name }}</option>

                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="rooms">Numero di stanze</label>
                <input class="form-control" type="number" name="rooms"
                value="{{ !$errors->any() ? $dwelling->rooms : old('rooms') }}">
            </div>

            <div class="mb-3">
                <label for="beds">Numero di letti</label>
                <input class="form-control" type="number" name="beds"
                value="{{ !$errors->any() ? $dwelling->beds : old('beds') }}">
            </div>

            <div class="mb-3">
                <label for="bathrooms">Numero di bagni</label>
                <input class="form-control" type="number" name="bathrooms"
                value="{{ !$errors->any() ? $dwelling->bathrooms : old('bathrooms') }}">
            </div>

            <div class="mb-3">
                <label for="dimentions">Metri quadri della struttura</label>
                <input class="form-control" type="number" name="dimentions"
                value="{{ !$errors->any() ? $dwelling->dimentions : old('dimentions') }}">
            </div>

            <div class="mb-3">
                <label for="address">Inserisci la via, con civico se presente</label>
                <input class="form-control" type="text" name="address"
                value="{{ !$errors->any() ? $dwelling->address : old('address') }}">
            </div>

            <div class="mb-3">
                <label for="city">Città in cui si trova</label>
                <input class="form-control" type="text" name="city"
                value="{{ !$errors->any() ? $dwelling->city : old('city') }}">
            </div>

            <div class="mb-3">
                <label for="description">Descrizione dell'appartamento</label>
                <input class="form-control" type="text" name="description"
                value="{{ !$errors->any() ? $dwelling->description : old('description') }}">
            </div>

            <div class="mb-3">
                <label for="image">Carica un'immagine della struttura</label>
                <input class="form-control" type="text" name="image"
                value="{{ !$errors->any() ? $dwelling->image : old('image') }}">
            </div>

            <div class="mb-3">
                <label for="price">Prezzo per notte</label>
                <input class="form-control" type="number" name="price"
                value="{{ !$errors->any() ? $dwelling->price : old('price') }}">
            </div>

            <div class="mb-3">
                <input class="btn btn-primary" type="submit" value="Aggiorna modifiche">
            </div>

    </form>
</div>
@endsection
