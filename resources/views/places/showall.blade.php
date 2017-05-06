@extends('layouts.master')

@section('content')

        @if(count($places) == 0)
            <span class='exception'>You don't have any favorite places yet; would you like to <a href='/places/new'>add one</a></span>?
        @else

            <a href="/places/new"><input type='button' value='Add a Place' class='btn btn-primary btn-small'></a>

         @foreach($places as $place)

            <div class='place cf'>

                <h2>{{ $place->name }}</h2>

                <a href='/places{{ $place->id }}'><img id='imgShowOne' src='{{ $place->place_image }}' alt='Image {{ $place->name }}'></a>

                <a class='placeAction' href='/places/edit/{{ $place->id }}'><i class='fa fa-pencil'></i></a>
                <a class='locationAction' href='/places/show/{{ $place->id }}'><i class='fa fa-eye'></i></a>
                <a class='placeAction' href='/places/delete/{{ $place->id }}'><i class='fa fa-trash'></i></a>

                <br><br>
                <p><a href='{{ $place->place_link }}'>Website</a></p>

                <p>Location: {{ $place->location->city }}, {{ $place->location->state}}, {{ $place->location->country}}</p>
                <p>Added on: {{ $place->created_at }}</p>
                <p>Last updated: {{ $place->updated_at }}</p>

                <br>

            </div>

        @endforeach
    @endif
@endsection
