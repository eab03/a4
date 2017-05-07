@extends('layouts.master')

@section('content')

    <div class='locations' class='cf'>
        <div class="top">
            <h1>{{ $location->city }}</h1>
            <a href="/places/search"><input type='button' value='Search for a Place' class='btn btn-primary btn-small'></a>
            <hr>
        </div>

        <div>
            <h3>{{ $location->city }}, {{ $location->state }}, {{ $location->country}}</h3>
            <img class='imgShowOne' src='{{ $location->location_image }}' alt='Image {{ $location->city }}'>

            <a class='locationAction' href='/locations/edit/{{ $location->id }}'><i class='fa fa-pencil'></i></a>
            <a class='locationAction' href='/locations/delete/{{ $location->id }}'><i class='fa fa-trash'></i></a>
        </div>

        <a href="/locations/showall"><input type='button' value='Show all Locations' class='btn btn-primary btn-small'></a>
    </div>

@endsection
