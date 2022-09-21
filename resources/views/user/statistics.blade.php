@extends('layouts.app')

@section('content')
    <div class="w-100 pt-5">

        <div class="mb-4">
            <h4 class="text-center">Scegli il mese da controllare</h4>
            <select onchange="createGraphs()" class="d-block m-auto" id="months">
                @foreach ($months as $month)
                    <option @if ($loop->iteration == $this_month) selected @endif
                    id="{{ $loop->iteration }}" value="{{ $loop->iteration }}">{{ $month }}</option>
                @endforeach
            </select>
        </div>

        <div class="d-flex w-100 flex-wrap">
            @foreach ($dwellings as $dwelling )
                <div class="ml-5 mb-5 w-45">
                    <h2 class="text-center">{{ $dwelling->name }}</h2>
                    <div id="myPlot{{$loop->iteration}}"></div>
                </div>
            @endforeach
        </div>


        <script>
            let dwellings = {!! json_encode($dwellings) !!};
            let views = {!! json_encode($all_views) !!};

            let select = document.getElementById('months');

            document.body.addEventListener('load', createGraphs());

            function createGraphs() {
                dwellings.forEach((dwelling, index) => {

                    document.getElementById(`myPlot${index + 1}`).innerHtml = null;

                    const monthsLenght = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];

                    var xArray = [];
                    var yArray = [];

                    for (let i = 1; i < monthsLenght[ parseInt(select.value) - 1] + 1; i++) {

                        xArray.push(i);
                    }

                    xArray.forEach(day => {
                        let count = 0;
                        let adjustedSelectValue = null;

                        if (select.value.length == 1) {

                            adjustedSelectValue = `0${select.value}`;
                        }
                        else {

                            adjustedSelectValue = select.value;
                        }

                        let adjustedDay = null;

                        if (day.toString().length == 1) {

                            adjustedDay = `0${day}`;
                        }
                        else {

                            adjustedDay = day;
                        }

                        views.forEach(view => {

                            let view_data = view.created_at.split(' ');

                            let view_month_day = view_data[0].substring(5, 10);

                            console.log(view_month_day, `${adjustedSelectValue}-${adjustedDay}`);

                            if (view.dwelling_id == dwelling.id && view_month_day == `${adjustedSelectValue}-${adjustedDay}`) {

                                count++;
                            }
                        });

                        yArray.push(count);
                    });

                    // Define Data
                    var data = [{
                      x: xArray,
                      y: yArray,
                      mode:"lines"
                    }];

                    // Define Layout
                    let selectedMonth = document.getElementById(select.value);

                    var layout = {
                      xaxis: {range: [1, 31], title: "Giorno"},
                      yaxis: {range: [0, 20], title: "Visualizzazioni"},
                      title: `Visualizzazioni giornaliere ${selectedMonth.innerText}`
                    };

                    // Display using Plotly
                    Plotly.newPlot(`myPlot${index + 1}`, data, layout);
                });
            }
        </script>

    </div>
@endsection
