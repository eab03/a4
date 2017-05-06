@extends('layouts.master')

@section('title')
    Confirm deletion: {{ $location->city }}
@endsection

@section('content')

    <h1>Confirm deletion</h1>
    <form method='POST' action='/locations/delete'>

        {{ csrf_field() }}

        <input type='hidden' name='id' value='{{ $location->id }}'?>

        <h2>Are you sure you want to delete:<br><em>{{ $location->city }}</em>?</h2>

        <input type='submit' value='Yes, delete this city.' class='btn btn-danger'>

    </form>

@endsection
