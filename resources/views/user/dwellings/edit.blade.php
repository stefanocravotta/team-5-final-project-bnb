@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Modifica il tuo appartamento</h2>
    <form action="{{ route('user.dwellings.update',$dwelling) }}" method="POST" id="form-edit">
        @csrf
        @method('PUT')

        <div class="mb-3">
                <label for="name">Nome della struttura*</label>
                <input class="form-control" type="text" name="name" id="name"
                value="{{ !$errors->any() ? $dwelling->name : old('name') }}"
                class="form-control @error('name') is-invalid @enderror">

                @error('name')
                    <p class="error-msg text-danger"> {{ $message }} </p>
                @enderror

                <p id="error-name" class="text-danger"></p>

        </div>

            <div class="mb-3">
                <label for="category">Tipo di struttura*</label>
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

                @error('category')
                    <p class="error-msg text-danger"> {{ $message }} </p>
                @enderror

            </div>

            <div class="mb-3">
                <label for="rooms">Numero di stanze</label>
                <input class="form-control" type="number" name="rooms" id="rooms"
                value="{{ !$errors->any() ? $dwelling->rooms : old('rooms') }}">

                @error('rooms')
                    <p class="error-msg text-danger"> {{ $message }} </p>
                @enderror

                <p id="error-rooms" class="text-danger"></p>


            </div>

            <div class="mb-3">
                <label for="beds">Numero di letti</label>
                <input class="form-control" type="number" name="beds" id="beds"
                value="{{ !$errors->any() ? $dwelling->beds : old('beds') }}">

                @error('beds')
                    <p class="error-msg text-danger"> {{ $message }} </p>
                @enderror

                <p id="error-beds" class="text-danger"></p>

            </div>

            <div class="mb-3">
                <label for="bathrooms">Numero di bagni</label>
                <input class="form-control" type="number" name="bathrooms" id="bathrooms"
                value="{{ !$errors->any() ? $dwelling->bathrooms : old('bathrooms') }}">

                @error('bathrooms')
                    <p class="error-msg text-danger"> {{ $message }} </p>
                @enderror

                <p id="error-bathrooms" class="text-danger"></p>


            </div>

            <div class="mb-3">
                <label for="dimentions">Metri quadri della struttura</label>
                <input class="form-control" type="number" placeholder="mq" name="dimentions" id="dimentions"
                value="{{ !$errors->any() ? $dwelling->dimentions : old('dimentions') }}">

                @error('dimentions')
                    <p class="error-msg text-danger"> {{ $message }} </p>
                @enderror

                <p id="error-dimentions" class="text-danger"></p>

            </div>

            <div class="mb-3">
                <label for="address">Inserisci la via, con civico se presente*</label>
                <input class="form-control" type="text" name="address" id="address"
                value="{{ !$errors->any() ? $dwelling->address : old('address') }}">

                @error('address')
                    <p class="error-msg text-danger"> {{ $message }} </p>
                @enderror

                <p id="error-address" class="text-danger"></p>

            </div>

            <div class="mb-3">
                <label for="city">Città in cui si trova*</label>
                <input class="form-control" type="text" name="city" id="city"
                value="{{ !$errors->any() ? $dwelling->city : old('city') }}">

                @error('city')
                    <p class="error-msg text-danger"> {{ $message }} </p>
                @enderror

                <p id="error-city" class="text-danger"></p>

            </div>

            <div class="mb-3">
                <label for="image">Carica un'immagine della struttura</label>
                <input class="form-control" type="text" name="image" id="image"
                value="{{ !$errors->any() ? $dwelling->image : old('image') }}">

                @error('image')
                    <p class="error-msg text-danger"> {{ $message }} </p>
                @enderror

                <p id="error-image" class="text-danger"></p>

            </div>

            <div class="mb-3">
                <label for="price">Prezzo per notte *</label>
                <input class="form-control" type="text" name="price" id="price"
                value="{{ !$errors->any() ? $dwelling->price : old('price') }}">

                @error('price')
                    <p class="error-msg text-danger"> {{ $message }} </p>
                @enderror

                <p id="error-price" class="text-danger"></p>

            </div>

            <div class="mb-3">
                <label for="description">Descrizione dell'appartamento</label>
                <textarea class="form-control" type="text" name="description" id="description" cols="30" rows="10"
                @if ($errors->any())
                    value="{{ old('description') }}"
                @endif></textarea>

                @error('description')
                    <p class="error-msg text-danger"> {{ $message }} </p>
                @enderror

                <p id="error-description" class="text-danger"></p>

            </div>
            <div class="mb-3">
                <button class="btn btn-primary" name="visible" type="button" value="1" data-toggle="modal" data-target="#modal-public">Pubblica</button>
                <button class="btn btn-primary" name="visible" type="submit" value="0">Salva in bozza</button>
            </div>

            <div class="modal fade" id="modal-public" tabindex="-1" aria-labelledby="modal-public-label" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modal-public-label">Vuoi pubblicare?</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Sei sicuro di aver compilato tutte le informazioni correttamente?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Chiudi</button>
                            <button type="submit" class="btn btn-success">Pubblica</button>
                        </div>
                    </div>
                </div>
            </div>

    </form>
</div>
@endsection
