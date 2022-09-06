@extends('layouts.app')

@section('content')
<div class="container mb-containerMsg">
    <h2>I tuoi messaggi:</h2>
    @foreach ($dwellings as $dwelling)
    @if (count($dwelling->messages) > 0)
    <h2>{{$dwelling->name}}</h2>
    <div class="container-fluid">
        <div class="card my-3 row-cols-4 flex-row flex-wrap mb-rowOfText">
        @foreach ($dwelling->messages as $message)
        <div>
                <div class="mb-infoTxt">

                        <h4>{{$message->created_at}}</h4>
                        <h3>{{$message->sender_email}}</h3>
                        <h3 class="mb-textCut">{{$message->text}}</h3>


                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal{{$message->id}}">
                            mostra tutto il messaggio
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="modal{{$message->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                <button type="button" class="btn btn-dark" data-dismiss="modal" aria-label="Close">X</button>
                                </div>
                                <div class="modal-body">
                                {{$message->text}}
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>



                @endforeach
            </div>

    </div>

    @endif
    @endforeach
    {{-- <div class="first">

    </div >
    <div class="second">

    </div> --}}
</div>
@endsection
