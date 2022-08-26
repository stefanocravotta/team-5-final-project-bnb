@extends('layouts.app')
@section('content')
    <div>
        <form action="{{ route('user.dwellings.store') }}" method="POST">
            @csrf

            <input type="text" name="name">

            <select name="category">
                @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{ $category->name }}</option>
                @endforeach
            </select>

            <input type="number" name="rooms">

            <input type="number" name="beds">

            <input type="number" name="bathrooms">

            <input type="number" name="dimentions">

            <input type="text" name="address">

            <input type="text" name="city">

            <input type="text" name="description">

            <input type="text" name="image">

            <input type="number" name="price">

            <input type="submit" value="aggiungi">





        </form>
    </div>
@endsection
