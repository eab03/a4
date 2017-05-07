@extends('layouts.master')

@section('title')
    Confirm deletion: {{ $location->city }}
@endsection

@section('content')
    <div class="top">
        <h1>Confirm Deletion</h1>
        <hr>
    </div>

    <form method='POST' action='/locations/delete'>

        {{ csrf_field() }}

        <input type='hidden' name='id' value='{{ $location->id }}'?>

        <h2>Are you sure you want to delete:<br><em>{{ $location->city }}</em>?</h2>

        <input type='submit' value='Yes, delete this city.' class='btn btn-danger'>
        <a href="/locations/show/{{ $location->id }}"><input type='button' value='No. Return to "{{ $location->city }}".' class='btn btn-primary btn-small'></a>

    </form>

@endsection
