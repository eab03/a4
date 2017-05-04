@extends('layouts.master')

@push('head')
    <link href='/css/a4.css' rel='stylesheet'>
@endpush

@section('title')
    Fun Places to Go!
@endsection

@section('content')

    @if(count($places) > 0)
        <section id="newPlaces">
            <h2>New Places Added!</h2>
            <ul>
                @foreach($places as $place)
                    <li class='truncate'><a href='/places/show{{ $place->id }}'>{{ $place->place_name }} </a> located in <a href='/locations/show{{ $place->id }}'>{{ $place->location->city }}, {{ $place->location->state }}</a> added {{ $place->created_at->diffForHumans()}}</li>
                @endforeach
            </ul>
        </section>
    @endif

    <section id='newLocations' class='cf'>
        <h2>Your Recent Locations</h2>
        @if(count($locations) == 0)
            You don't have any favorite places yet; would you like to <a href='/locations/new'>add one</a>?
        @else
            @foreach($locations as $location)

                <div class='location cf'>
                    <ul>
                        <li>
                            <a href='/locations/show/{id}{{ $location->id }}'><h3>{{ $location->city }}, {{ $location->state }}, {{ $location->country }}</h3></a>
                            <a href='/locations/show/{id}{{ $location->id }}'><img class='locationImg' src='{{ $location->location_image }}' alt='Image {{ $location->city }}'></a>

                            <a class='locationAction' href='/locations/edit{id}{{ $location->id }}'><i class='fa fa-pencil'></i></a>
                            <a class='locationAction' href='/locations/show{id}{{ $location->id }}'><i class='fa fa-eye'></i></a>
                            <a class='locationAction' href='/locations/delete{id}{{ $location->id }}'><i class='fa fa-trash'></i></a>
                        </li>
                    </ul>
                </div>
            @endforeach
        @endif
    </section>

@endsection
