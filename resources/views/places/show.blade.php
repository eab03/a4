@extends('layouts.master')

@section('content')

    <div class='place cf'>

        <h1>{{ $place->place_name }}</h1>

        <a href='/places{{ $place->id }}'><img id='imgShowOne' src='{{ $place->place_image }}' alt='Image {{ $place->place_name }}'></a>

        <p><a href='{{ $place->place_link }}'>Check out this Place!</a></p>

        <p>Location: {{ $place->location->city }}, {{ $place->location->state}}, {{ $place->location->country}}</p>
        <p>Added on: {{ $place->created_at }}</p>
        <p>Last updated: {{ $place->updated_at }}</p>

        <a class='placeAction' href='/places/edit/{{ $place->id }}'><i class='fa fa-pencil'></i></a>
        <a class='placeAction' href='/places/delete/{{ $place->id }}/delete'><i class='fa fa-trash'></i></a>

    </div>

@endsection
