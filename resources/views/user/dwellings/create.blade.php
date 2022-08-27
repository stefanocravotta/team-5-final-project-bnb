@extends('layouts.app')
@section('content')
    <div class="container">
        <form action="{{ route('user.dwellings.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <input class="form-control" type="text" name="name">
            </div>
            <div class="mb-3">
                <select class="form-control" name="category">
                    @foreach ($categories as $category)
                        <option value="{{$category->id}}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <input class="form-control" type="number" name="rooms">
            </div>
            <div class="mb-3">
                <input class="form-control" type="number" name="beds">
            </div>
            <div class="mb-3">
                <input class="form-control" type="number" name="bathrooms">
            </div>
            <div class="mb-3">
                <input class="form-control" type="number" name="dimentions">
            </div>
            <div class="mb-3">
                <input class="form-control" type="text" name="address">
            </div>
            <div class="mb-3">
                <input class="form-control" type="text" name="city">
            </div>
            <div class="mb-3">
                <input class="form-control" type="text" name="description">
            </div>
            <div class="mb-3">
                <input class="form-control" type="text" name="image">
            </div>
            <div class="mb-3">
                <input class="form-control" type="number" name="price">
            </div>
            <div class="mb-3">
                <input class="form-control" type="submit" value="aggiungi">
            </div>





        </form>
    </div>
@endsection
