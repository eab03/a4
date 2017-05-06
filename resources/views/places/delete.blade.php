@extends('layouts.master')

@section('title')
    Confirm deletion: {{ $place->place_name }}
@endsection

@section('content')

    <h1>Confirm deletion</h1>
    <form method='POST' action='/places/delete'>

        {{ csrf_field() }}

        <input type='hidden' name='id' value='{{ $place->id }}'?>

        <h2>Are you sure you want to delete:<br><em>{{ $place->name }}</em>?</h2>

        <input type='submit' value='Yes, delete this place.' class='btn btn-danger'>

        @include('errors')

    </form>

@endsection
