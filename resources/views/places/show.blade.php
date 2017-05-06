@extends('layouts.master')

@section('content')

    <div class='place cf'>

        <h1>{{ $place->name }}</h1>

        <a href='/places{{ $place->id }}'><img id='imgShowOne' src='{{ $place->place_image }}' alt='Image {{ $place->name }}'></a>

        <a class='placeAction' href='/places/edit/{{ $place->id }}'><i class='fa fa-pencil'></i></a>
        <a class='placeAction' href='/places/show/{{ $place->id }}'><i class='fa fa-eye'></i></a>
        <a class='placeAction' href='/places/delete/{{ $place->id }}'><i class='fa fa-trash'></i></a>

        <br><br>
        <p><a href='{{ $place->place_link }}'>Website</a></p>
        <p>Location: {{ $place->location->city }}, {{ $place->location->state}}, {{ $place->location->country}}</p>
        <p>Added on: {{ $place->created_at }}</p>
        <p>Last updated: {{ $place->updated_at }}</p>

        <label>Tags</label>
            <ul id='tags'>
                @foreach($tagsForThisPlace as $id => $name)
                    <li>{{ $name }}</li>
                @endforeach
            </ul>

    </div>

@endsection
