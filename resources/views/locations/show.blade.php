@extends('layouts.master')

@section('content')

    <section id='locationsShow' class='cf'>
        <h2>Your Cities</h2>

        <a href="/places/search"><input type='button' value='Search for a Place' class='btn btn-primary btn-small'></a>
        <a href="/locations/showall"><input type='button' value='Show all Locations' class='btn btn-primary btn-small'></a>

                <div class='location cf'>
                    <h3>{{ $location->city }}, {{ $location->state }}, {{ $location->country}}</h3>
                    <img class='locationImg' src='{{ $location->location_image }}' alt='Image {{ $location->city }}'>

                    <a class='locationAction' href='/locations/edit/{{ $location->id }}'><i class='fa fa-pencil'></i></a>
                    <a class='locationAction' href='/locations/delete/{{ $location->id }}'><i class='fa fa-trash'></i></a>

                </div>
    </section>

@endsection
