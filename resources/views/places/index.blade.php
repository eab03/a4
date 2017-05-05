@extends('layouts.master')

@push('head')
    <link href='/css/a4.css' rel='stylesheet'>
@endpush

@section('title')
    My Recent Places!
@endsection

@section('content')

@if(count($newPlaces) > 0)
    <section id='newPlaces'>
        <h2>Latest Places!</h2>
        <ul>
            @foreach($newPlaces as $place)
                <li class='truncate'><a href='places/show/{{ $place->id }}'>{{ $place->place_name }}</a> updated {{ $place->updated_at->diffForHumans()}}</li>
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
                            <a href='locations/show/{{ $location->id }}'><h3>{{ $location->city }}, {{ $location->state }}, {{ $location->country }}</h3></a>
                            <a href='locations/show/{{ $location->id }}'><img class='locationImg' src='{{ $location->location_image }}' alt='Image {{ $location->city }}'></a>

                            <a class='locationAction' href='/locations/edit/{{  $location->id }}'><i class='fa fa-pencil'></i></a>
                            <a class='locationAction' href='locations/show/{{ $location->id }}'><i class='fa fa-eye'></i></a>
                            <a class='locationAction' href='/locations/delete/{{ $location->id }}'><i class='fa fa-trash'></i></a>
                        </li>
                    </ul>
                </div>
            @endforeach
        @endif
    </section>

@endsection
