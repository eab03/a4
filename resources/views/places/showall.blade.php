@extends('layouts.master')

@section('content')

    <div class="top">
        <h1>Favorite Places</h1>
        <a href="/places/new"><input type='button' value='Add a New Place!' class='btn btn-primary btn-small'></a>
        <a href="/places/search"><input type='button' value='Search for a Place!' class='btn btn-primary btn-small'></a>
    </div>

        @if(count($places) == 0)
            <span class='exception'>You don't have any favorite places yet; would you like to <a href='/places/new'>add one</a></span>?
        @else

         @foreach($places as $place)

            <div class='place cf'>

                <h3><a href='/places/show/{{ $place->id }}'>{{ $place->name }}</h3></a>

                <div class="place">
                    <div class="placeAllRight">
                        <p>Notes:</p>
                    </div>

                    <div class="placeAllLeft">
                        <a href='/places/show/{{ $place->id }}'><img class='imgShowAll' src='{{ $place->place_image }}' alt='Image {{ $place->name }}'></a>

                        <a class='placeAction' href='/places/edit/{{ $place->id }}'><i class='fa fa-pencil'></i></a>
                        <a class='locationAction' href='/places/show/{{ $place->id }}'><i class='fa fa-eye'></i></a>
                        <a class='placeAction' href='/places/delete/{{ $place->id }}'><i class='fa fa-trash'></i></a>

                        <br><br>
                        <p><a href='{{ $place->place_link }}'>Website</a></p>

                        <p>Location: {{ $place->location->city }}, {{ $place->location->state}}, {{ $place->location->country}}</p>
                        <p>Last updated: {{ $place->updated_at->diffForHumans()}}</p>
                        <br>
                        <hr>
                    </div>
                </div>
            </div>

        @endforeach
    @endif
@endsection
