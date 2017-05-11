@extends('layouts.master')

@section('content')

    <div class='locations' class='cf'>
        <div class="top">
            @if( $location->state !=null)
                <h1>{{ $location->city }}, {{ $location->state }}, {{ $location->country}}</h1>
            @else
                <h1>{{ $location->city }}, {{ $location->country}}</h1>
            @endif

            <a href="/places/search"><input type='button' value='Search for a Place' class='btn btn-info btn-small'></a>
            <hr>
        </div>

        <div>
            <img class='imgShowOne' src='{{ $location->location_image }}' alt='Image {{ $location->city }}'>

            <a class='locationAction' href='/locations/edit/{{ $location->id }}'><i class='fa fa-pencil'></i></a>
            <a class='locationAction' href='/locations/delete/{{ $location->id }}'><i class='fa fa-trash'></i></a>
        </div>

        <a href="/locations/showall"><input type='button' value='Show all Locations' class='btn btn-primary btn-small'></a>
    </div>

@endsection
