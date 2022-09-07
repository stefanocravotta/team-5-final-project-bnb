@extends('layouts.app')

@section('content')
<div class="container-fluid mb-containerMsg">
    <h2>I tuoi messaggi:</h2>
    @foreach ($dwellings as $dwelling)
    @if (count($dwelling->messages) > 0)
    <h2>{{$dwelling->name}}:</h2>

    <div class="container-fluid">
        <div class="card my-3 flex-column flex-wrap mb-rowOfText">
        @foreach ($dwelling->messages as $message)
        <div class=" w-100">
                <ul class="mb-infoTxt d-flex justify-content-between">
                    <li class="d-flex justify-content-between">
                        <p class="mb-date">{{$message->created_at}}</p>
                        <p class="mb-sender">{{$message->sender_email}}</ class="mb-text">
                        <p class="mb-textCut">{{$message->text}}</p>


                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modal{{$message->id}}">
                            mostra tutto il messaggio
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="modal{{$message->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel{{$message->id}}">{{$message->sender_email}}</h5>
                                <button type="button" class="btn btn-secondarty" data-dismiss="modal" aria-label="Close">X</button>
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
                        </li>
                    </ul>
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
