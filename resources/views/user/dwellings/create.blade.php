@extends('layouts.app')
@section('content')
    <div class="container">
        <h2>Crea un appartamento</h2>
        <form action="{{ route('user.dwellings.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="name">Nome della struttura</label>
                <input class="form-control" type="text" name="name"
                @if ($errors->any())
                    value="{{ old('name') }}"
                @endif>
            </div>

            <div class="mb-3">
                <label for="category">Tipo di struttura</label>
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

            <div class="mb-3">
                <label for="rooms">Numero di stanze</label>
                <input class="form-control" type="number" name="rooms"
                @if ($errors->any())
                    value="{{ old('rooms') }}"
                @endif>
            </div>

            <div class="mb-3">
                <label for="beds">Numero di letti</label>
                <input class="form-control" type="number" name="beds"
                @if ($errors->any())
                    value="{{ old('beds') }}"
                @endif>
            </div>

            <div class="mb-3">
                <label for="bathrooms">Numero di bagni</label>
                <input class="form-control" type="number" name="bathrooms"
                @if ($errors->any())
                    value="{{ old('bathrooms') }}"
                @endif>
            </div>

            <div class="mb-3">
                <label for="dimentions">Metri quadri della struttura</label>
                <input class="form-control" type="number" name="dimentions"
                @if ($errors->any())
                    value="{{ old('dimentions') }}"
                @endif>
            </div>

            <div class="mb-3">
                <label for="address">Inserisci la via, con civico se presente</label>
                <input class="form-control" type="text" name="address"
                @if ($errors->any())
                    value="{{ old('address') }}"
                @endif>
            </div>

            <div class="mb-3">
                <label for="city">Città in cui si trova</label>
                <input class="form-control" type="text" name="city"
                @if ($errors->any())
                    value="{{ old('city') }}"
                @endif>
            </div>

            <div class="mb-3">
                <label for="description">Descrizione dell'appartamento</label>
                <input class="form-control" type="text" name="description"
                @if ($errors->any())
                    value="{{ old('description') }}"
                @endif>
            </div>

            <div class="mb-3">
                <label for="image">Carica un'immagine della struttura</label>
                <input class="form-control" type="text" name="image"
                @if ($errors->any())
                    value="{{ old('image') }}"
                @endif>
            </div>

            <div class="mb-3">
                <label for="price">Prezzo per notte</label>
                <input class="form-control" type="number" name="price"
                @if ($errors->any())
                    value="{{ old('price') }}"
                @endif>
            </div>

            <div class="mb-3">
                <input class="btn btn-primary" type="submit" value="Aggiungi">
            </div>

        </form>
    </div>
@endsection
