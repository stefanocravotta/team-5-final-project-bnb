@extends('layouts.app')
@section('content')
    <div class="container">
        <h2>Crea un appartamento</h2>
        <form action="{{ route('user.dwellings.store') }}" method="POST">
            @csrf

            <label for="name">Nome della struttura</label>
            <div class="mb-3">
                <input class="form-control" type="text" name="name"
                @if ($errors->any())
                    value="{{ old('name') }}"
                @endif>
            </div>

            <label for="category">Tipo di struttura</label>
            <div class="mb-3">
                <select class="form-control" name="category">
                    @foreach ($categories as $category)

                        <option value="{{$category->id}}"
                        @if ($errors->any() && $category->id == old('category_id'))
                            selected
                        @endif>
                        {{ $category->name }}</option>

                    @endforeach
                </select>
            </div>

            <label for="rooms">Numero di stanze</label>
            <div class="mb-3">
                <input class="form-control" type="number" name="rooms"
                @if ($errors->any())
                    value="{{ old('rooms') }}"
                @endif>
            </div>

            <label for="beds">Numero di letti</label>
            <div class="mb-3">
                <input class="form-control" type="number" name="beds"
                @if ($errors->any())
                    value="{{ old('beds') }}"
                @endif>
            </div>

            <label for="bathrooms">Numero di bagni</label>
            <div class="mb-3">
                <input class="form-control" type="number" name="bathrooms"
                @if ($errors->any())
                    value="{{ old('bathrooms') }}"
                @endif>
            </div>

            <label for="dimentions">Metri quadri della struttura</label>
            <div class="mb-3">
                <input class="form-control" type="number" name="dimentions"
                @if ($errors->any())
                    value="{{ old('dimentions') }}"
                @endif>
            </div>

            <label for="address">Inserisci la via, con civico se presente</label>
            <div class="mb-3">
                <input class="form-control" type="text" name="address"
                @if ($errors->any())
                    value="{{ old('address') }}"
                @endif>
            </div>

            <label for="city">Città in cui si trova</label>
            <div class="mb-3">
                <input class="form-control" type="text" name="city"
                @if ($errors->any())
                    value="{{ old('city') }}"
                @endif>
            </div>

            <label for="description">Descrizione dell'appartamento</label>
            <div class="mb-3">
                <input class="form-control" type="text" name="description"
                @if ($errors->any())
                    value="{{ old('description') }}"
                @endif>
            </div>

            <label for="image">Carica un'immagine della struttura</label>
            <div class="mb-3">
                <input class="form-control" type="text" name="image"
                @if ($errors->any())
                    value="{{ old('image') }}"
                @endif>
            </div>

            <label for="price">Prezzo per notte</label>
            <div class="mb-3">
                <input class="form-control" type="number" name="price"
                @if ($errors->any())
                    value="{{ old('price') }}"
                @endif>
            </div>

            <div class="mb-3">
                <input class="form-control" type="submit" value="Aggiungi">
            </div>

        </form>
    </div>
@endsection
