@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Modifica il tuo appartamento</h2>
    <form action="{{ route('user.dwellings.store') }}" method="POST">
        @csrf
        @method('PUT')

            <label for="name">Nome della struttura</label>
            <div class="mb-3">
                <input class="form-control" type="text" name="name"
                value="{{ !$errors->any() ? $dwelling->name : old('name') }}">
            </div>

            <label for="category">Tipo di struttura</label>
            <div class="mb-3">
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

            <label for="rooms">Numero di stanze</label>
            <div class="mb-3">
                <input class="form-control" type="number" name="rooms"
                value="{{ !$errors->any() ? $dwelling->rooms : old('rooms') }}">
            </div>

            <label for="beds">Numero di letti</label>
            <div class="mb-3">
                <input class="form-control" type="number" name="beds"
                value="{{ !$errors->any() ? $dwelling->beds : old('beds') }}">
            </div>

            <label for="bathrooms">Numero di bagni</label>
            <div class="mb-3">
                <input class="form-control" type="number" name="bathrooms"
                value="{{ !$errors->any() ? $dwelling->bathrooms : old('bathrooms') }}">
            </div>

            <label for="dimentions">Metri quadri della struttura</label>
            <div class="mb-3">
                <input class="form-control" type="number" name="dimentions"
                value="{{ !$errors->any() ? $dwelling->dimentions : old('dimentions') }}">
            </div>

            <label for="address">Inserisci la via, con civico se presente</label>
            <div class="mb-3">
                <input class="form-control" type="text" name="address"
                value="{{ !$errors->any() ? $dwelling->address : old('address') }}">
            </div>

            <label for="city">Città in cui si trova</label>
            <div class="mb-3">
                <input class="form-control" type="text" name="city"
                value="{{ !$errors->any() ? $dwelling->city : old('city') }}">
            </div>

            <label for="description">Descrizione dell'appartamento</label>
            <div class="mb-3">
                <input class="form-control" type="text" name="description"
                value="{{ !$errors->any() ? $dwelling->description : old('description') }}">
            </div>

            <label for="image">Carica un'immagine della struttura</label>
            <div class="mb-3">
                <input class="form-control" type="text" name="image"
                value="{{ !$errors->any() ? $dwelling->image : old('image') }}">
            </div>

            <label for="price">Prezzo per notte</label>
            <div class="mb-3">
                <input class="form-control" type="number" name="price"
                value="{{ !$errors->any() ? $dwelling->price : old('price') }}">
            </div>

            <div class="mb-3">
                <input class="form-control" type="submit" value="Aggiorna modifiche">
            </div>

    </form>
</div>
@endsection
