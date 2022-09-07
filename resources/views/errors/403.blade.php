@extends('layouts.app')
@section('content')
<div class="error-wrap">
    <h1>403-Forbidden</h1>
    <div>You don't have permission to access this resource</div>
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
