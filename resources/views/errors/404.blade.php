@extends('layouts.app')
@section('content')
    <div class="error-wrap">
        <h1>404</h1>
        <div>Sorry the page you are looking for could not be found</div>
    </div>
@endsection
<style>
    .error-wrap{
       display: flex;
       flex-direction: column;
       align-items: center;
       justify-content: center;
       height: 100vh;
    }
</style>
