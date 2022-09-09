@extends('layouts.app')
@section('content')
    <div class="container">
        @if(session('dwelling_created'))
            <div class="alert alert-success" role="alert">
                {{ session('dwelling_created') }}
            </div>
        @endif

        <div class="card dwelling-card mb-userShow">

            <div class="h-50">
                <div class="d-flex img-map-box">
                    <div class="w-60">
                        @if($dwelling->image)

                        <img class="dwelling-img" src="{{ asset('images/'.$dwelling->image) }}" class="card-img-top" alt="{{ $dwelling->name }}">

                        @else

                        <img class="dwelling-img" src="{{ asset('images/villa-affitto-italia-ada-1624884100.jpg') }}" alt="default">

                        @endif
                    </div>

                    <div id='map' class='map h-100 w-50'></div>
                </div>

                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title d-inline">{{ $dwelling->name }}</h3>
                        <div>
                            @foreach ($dwelling->perks as $perk)
                        <span class="badge badge-success">{{$perk->name}}</span>
                        @endforeach
                        </div>
                    </div>
                    <p class="card-text">{{ $dwelling->address }}, {{ $dwelling->city }}</p>
                    <p class="card-text">{{ $dwelling->description }}</p>
                </div>
            </div>

            <div class="d-flex dwelling-data">
                <div class="w-50 pr-2">
                    {{-- APARTMENTS PARAMS --}}
                    <ul class="list-group list-group-flush mb-listInfo">

                        <li class="list-group-item mb-listSingleInfo">Metri quadrati: {{ $dwelling->dimentions ? $dwelling->dimentions : "---" }}</li>

                        <li class="list-group-item mb-listSingleInfo">Numero di stanze: {{ $dwelling->rooms ? $dwelling->rooms : "---" }}</li>

                        <li class="list-group-item mb-listSingleInfo">Numero di bagni: {{ $dwelling->bathrooms ? $dwelling->bathrooms : "---" }}</li>

                        <li class="list-group-item mb-listSingleInfo">Posti letto: {{ $dwelling->beds ? $dwelling->beds : "---" }}</li>

                        <li class="list-group-item mb-listSingleInfo">Prezzo: {{ $dwelling->price }}&euro; /notte</li>

                    </ul>
                    {{-- /APARTMENTS PARAMS --}}


                    {{-- BOTTONI CARD --}}
                    <div class="card-body">
                        <div>
                            <a href="{{ route('user.dwellings.edit', $dwelling)}}" class="">
                                <button class="btn-inserisci">Modifica</button>
                            </a>
                            <form class="d-inline" action="{{ route('user.dwellings.destroy', $dwelling) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn-inserisci" data-toggle="modal" data-target="#modal-draft">
                                    Elimina
                                </button>
                            </div>
                            <a href="{{ route('user.dwellings.index')}}" class="btn-bozza d-block p-1"><i class="fa-solid fa-arrow-left"></i> Torna ai tuoi appartamenti</a>


                            <div class="modal fade" id="modal-draft" tabindex="-1" aria-labelledby="modal-draft-label" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modal-draft-label">Elimina appartamento</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Sei sicuro di voler eliminare l'appartamento {{ $dwelling->name }}?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    {{-- /BOTTONI CARD --}}
                </div>
                <div class="w-50 dwelling-msg pl-2">

                    @foreach ($messages as $message)
                        <div class="card">
                            <div class="faq-line clearfix mb-listInfo">
                                <span>{{ $message->sender_email }}</span>
                                <span><i class="fa-solid fa-chevron-down"></i></span>
                                <p class="drpdwn-p faq-text">{{ $message->text }}</p>
                                <p>{{ date_format($message->created_at, "d/m/Y")}}</p>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>

        </div>

        <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.20.0/maps/maps-web.min.js"></script>

        <script>
            var dwelling = {!! json_encode($dwelling) !!};
            var dwellingCoordinates = [dwelling.long, dwelling.lat];

            // ------- searchBox --------

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
            // document.body.append(searchBoxHTML);


            // -------- includere la mappa ------------
            tt.map({
                key: '0esiNqmzyhdAgeAwGRM5fRuozF0jWJgO',
                container: 'map'
            });

            var map = tt.map({
                key: '0esiNqmzyhdAgeAwGRM5fRuozF0jWJgO',
                container: 'map',
                center: dwellingCoordinates,
                zoom: 15
            });

            // --------- marker ----------

            var marker = new tt.Marker().setLngLat(dwellingCoordinates).addTo(map);

            var popupOffsets = {
              top: [0, 0],
              bottom: [0, -70],
              'bottom-right': [0, -70],
              'bottom-left': [0, -70],
              left: [25, -35],
              right: [-25, -35]
            }

            var popup = new tt.Popup({offset: popupOffsets}).setHTML(`<strong>${dwelling.address}</strong>`);
            marker.setPopup(popup).togglePopup();

            // ------- funzioni della mappa ---------

            function handleResultsFound(event) {
            var results = event.data.results.fuzzySearch.results;

            if (results.length === 0) {
                searchMarkersManager.clear();
            }
            searchMarkersManager.draw(results);
            fitToViewport(results);
            }

            function handleResultSelection(event) {
                var result = event.data.result;
                if (result.type === 'category' || result.type === 'brand') {
                    return;
                }
                searchMarkersManager.draw([result]);
                fitToViewport(result);
            }

            function fitToViewport(markerData) {
                if (!markerData || markerData instanceof Array && !markerData.length) {
                    return;
                }
                var bounds = new tt.LngLatBounds();
                if (markerData instanceof Array) {
                    markerData.forEach(function (marker) {
                        bounds.extend(getBounds(marker));
                    });
                } else {
                    bounds.extend(getBounds(markerData));
                }
                map.fitBounds(bounds, { padding: 100, linear: true });
            }

            function getBounds(data) {
                var btmRight;
                var topLeft;
                if (data.viewport) {
                    btmRight = [data.viewport.btmRightPoint.lng, data.viewport.btmRightPoint.lat];
                    topLeft = [data.viewport.topLeftPoint.lng, data.viewport.topLeftPoint.lat];
                }
                return [btmRight, topLeft];
            }

            function handleResultClearing() {
                searchMarkersManager.clear();
            }



        </script>

</div>

@endsection
