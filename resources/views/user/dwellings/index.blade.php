@extends('layouts.app')
@section('content')

        <div class="container">

            @if(session('dwelling_deleted'))
                <div class="alert alert-success" role="alert">
                    {{ session('dwelling_deleted') }}
                </div>
            @endif

            @if(session('not_allowed'))
                <div class="alert alert-danger d-flex justify-content-between" role="alert">
                    <p>{{ session('not_allowed') }}</p>
                    <a href="{{route('user.dwellings.index')}}" class="btn btn-danger">X</a>
                </div>
            @endif

            <h2>I tuoi appartamenti</h2>

        @if (count($dwellings_visible) > 0 )

        @foreach ($dwellings_visible as $dwelling)
            <p>{{$dwelling->name}}</p>

            <a href="{{route('user.dwellings.edit', $dwelling)}}"  class="btn btn-primary" >Edit</a>
            <a href="{{route('user.dwellings.show', $dwelling)}}"  class="btn btn-primary" >Show</a>

            <form action="{{ route('user.dwellings.destroy', $dwelling) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">
                Elimina
            </button>

            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      ...
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Delete</button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
        @endforeach

        @else

            <p>Non ci sono appartamenti pubblicati</p>

        @endif

        @if (count($dwellings_pending) > 0)

        <h2>Appartamenti in bozza</h2>

        @foreach ($dwellings_pending as $dwelling)
            <p>{{$dwelling->name}}</p>

            <a href="{{route('user.dwellings.edit', $dwelling)}}"  class="btn btn-primary" >Edit</a>
            <a href="{{route('user.dwellings.show', $dwelling)}}"  class="btn btn-primary" >Show</a>

            <form action="{{ route('user.dwellings.destroy', $dwelling) }}" method="POST">
            @csrf
            @method('DELETE')
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">
                    Elimina
                </button>

                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          ...
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary">Delete</button>
                        </div>
                      </div>
                    </div>
                  </div>


            </form>
        @endforeach

        @endif




@endsection


