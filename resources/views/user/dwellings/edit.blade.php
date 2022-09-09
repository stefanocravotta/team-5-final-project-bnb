@extends('layouts.app')
@section('content')
<div class="container">
    <div class="col-8 offset-2">
    <h2>Modifica il tuo appartamento</h2>
    <form action="{{ route('user.dwellings.update',$dwelling) }}" method="POST" id="form-edit" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
                <label for="name">Nome della struttura*</label>
                <input class="form-control styled-input" type="text" name="name" id="name"
                value="{{ !$errors->any() ? $dwelling->name : old('name') }}"
                class="form-control styled-input @error('name') is-invalid @enderror">

                @error('name')
                    <p class="error-msg text-danger"> {{ $message }} </p>
                @enderror

                <p id="error-name" class="text-danger"></p>

        </div>

        <div class="d-flex justify-content-between">
            <div class="mb-3 pr-1 w-50">
                <label for="category">Tipo di struttura*</label>
                <select class="form-control styled-input" name="category">
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

            <div class="mb-3 pl-1 w-50">
                <label for="rooms">Numero di stanze</label>
                <select class="form-control" name="rooms" id="rooms" value="{{ !$errors->any() ? $dwelling->rooms : old('rooms') }}">
                        @for ($i = 1; $i < 26; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>

                @error('rooms')
                    <p class="error-msg text-danger"> {{ $message }} </p>
                @enderror

                <p id="error-rooms" class="text-danger"></p>


            </div>
        </div>

        <div class="d-flex justify-content-between">

            <div class="mb-3 w-30">
                <label for="beds">Numero di letti</label>
                <select class="form-control" name="beds" id="beds" value="{{ !$errors->any() ? $dwelling->beds : old('beds') }}">
                    @for ($i = 1; $i < 26; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>

                @error('beds')
                    <p class="error-msg text-danger"> {{ $message }} </p>
                @enderror

                <p id="error-beds" class="text-danger"></p>

            </div>

            <div class="mb-3 w-30">
                <label for="bathrooms">Numero di bagni</label>
                <select class="form-control" name="bathrooms" id="bathrooms" value="{{ !$errors->any() ? $dwelling->bathrooms : old('bathrooms') }}">
                    @for ($i = 1; $i < 26; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>

                @error('bathrooms')
                    <p class="error-msg text-danger"> {{ $message }} </p>
                @enderror

                <p id="error-bathrooms" class="text-danger"></p>


            </div>

            <div class="mb-3 w-30">
                <label for="dimentions">Metri quadri della struttura</label>
                <input class="form-control" type="number" min="0" placeholder="0" name="dimentions" id="dimentions"
                value="{{ !$errors->any() ? $dwelling->dimentions : old('dimentions') }}">

                @error('dimentions')
                    <p class="error-msg text-danger"> {{ $message }} </p>
                @enderror

                <p id="error-dimentions" class="text-danger"></p>

            </div>
        </div>

        <div class="d-flex justify-content-between">
            <div class="mb-3 pr-1 w-100">
                <label for="address">Inserisci la via, con civico se presente *</label>

                <div id="searchBox-container">



                </div>

                @error('address')
                    <p class="error-msg text-danger"> {{ $message }} </p>
                @enderror

                <p id="error-address" class="text-danger"></p>

            </div>

        </div>

        <div class="d-flex justify-content-between">
            <div class="mb-3 w-50 pr-1">
                <label for="image">Carica un'immagine della struttura</label>
                <input class="form-control styled-input" type="file" accept="image/*" name="image" id="image"
                value="{{ !$errors->any() ? $dwelling->image : old('image') }}">

                @error('image')
                    <p class="error-msg text-danger"> {{ $message }} </p>
                @enderror

                <p id="error-image" class="text-danger"></p>

            </div>

            <div class="mb-3 w-50 pl-1">
                <label for="price">Prezzo per notte *</label>
                <input class="form-control styled-input" type="text" name="price" id="price"
                value="{{ !$errors->any() ? $dwelling->price : old('price') }}">

                @error('price')
                    <p class="error-msg text-danger"> {{ $message }} </p>
                @enderror

                <p id="error-price" class="text-danger"></p>

            </div>
        </div>

        <label for="">Seleziona almeno un servizio</label>
            <div class="mb-3">
                @foreach ($perks as $perk)
                    <input
                        type="checkbox"
                        name="perks[]"
                        id="perk{{ $loop->iteration }}"
                        value="{{ $perk->id }}"
                        @if(!$errors->any() && $dwelling->perks->contains($perk->id))
                        checked
                        @elseif(in_array($perk->id, old('perks',[]) ) )
                        checked
                        @endif
                    >

                    <label for="perk{{ $loop->iteration }}" class="mr-3">{{ $perk->name }}</label>
                @endforeach

                <p id="error-perks" class="text-danger"></p>
            </div>

            <div class="mb-3">
                <label for="description">Descrizione dell'appartamento</label>
                <textarea class="form-control" type="text" name="description" id="description" cols="30" rows="10">@if($errors->any()){{ old('description') }}@else{{$dwelling->description}}@endif</textarea>

                @error('description')
                    <p class="error-msg text-danger"> {{ $message }} </p>
                @enderror

                <p id="error-description" class="text-danger"></p>

            </div>
            <div class="mb-3">
                <button class="btn-pubblica" name="visible" type="button" value="1" data-toggle="modal" data-target="#modal-public">Pubblica</button>
                <button class="btn-bozza" name="visible" type="submit" value="0">Salva in bozza</button>
            </div>

            <div class="modal fade" id="modal-public" tabindex="-1" aria-labelledby="modal-public-label" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content mb-modalCont">
                        <div class="modal-header mb-modalCont">
                            <h5 class="modal-title mb-modalCont" id="modal-public-label">Vuoi pubblicare?</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Sei sicuro di aver compilato tutte le informazioni correttamente?</p>
                        </div>
                        <div class="modal-footer mb-modalFoot">
                            <button type="button" class="btn-chiudi" data-dismiss="modal">Chiudi</button>
                            <button type="submit" class="btn-inserisci">Pubblica</button>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>

    <script type="text/javascript">

        var options = {
        searchOptions: {
            key: '0esiNqmzyhdAgeAwGRM5fRuozF0jWJgO',
            language: 'en-GB',
            limit: 5
        },
        autocompleteOptions: {
            key: '0esiNqmzyhdAgeAwGRM5fRuozF0jWJgO',
            language: 'en-GB'
        }
        };

        var ttSearchBox = new tt.plugins.SearchBox(tt.services, options);
        var searchBoxHTML = ttSearchBox.getSearchBoxHTML();
        var container = document.getElementById('searchBox-container');
        container.append(searchBoxHTML);
        document.querySelector('.tt-search-box-input-container').classList.add('form-control');


        var errors = @json($errors->toArray());
        var errorsKeys = Object.keys(errors);
        var oldAddress = @json(old('address'));
        var dwellingAddress = @json($dwelling->address);

        var inputSearchBox = document.querySelector('.tt-search-box-input');
        inputSearchBox.setAttribute('name', 'address');
        inputSearchBox.setAttribute('id', 'address');
        inputSearchBox.setAttribute('autocomplete', 'off');
        inputSearchBox.setAttribute('type', 'text');

        if (errorsKeys.length > 0) {
            inputSearchBox.setAttribute('value', oldAddress);
        } else {
            inputSearchBox.setAttribute('value', dwellingAddress);
        }

    </script>
</div>
@endsection
