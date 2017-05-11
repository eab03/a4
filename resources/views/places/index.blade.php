@extends('layouts.master')

@push('head')
    <link href='/css/a4.css' rel='stylesheet'>
@endpush

@section('title')
    My Recent Places!
@endsection

@section('content')
    <div class="top">
        <h1>My Recent Places and Locations</h1>
        <hr>
    </div>

    @if(count($newPlaces) > 0)
        <section id='newPlaces'>
            <h2>Places</h2>
            @foreach($newPlaces as $place)
                <ul>
                    <li class='truncate'><a href='places/show/{{ $place->id }}'>{{ $place->name }}</a> ...updated {{ $place->updated_at->diffForHumans()}}</li>
                </ul>
            @endforeach
        </section>
    @endif

    <section id='newLocations' class='cf'>
        <h2>Locations</h2>
        @if(count($locations) == 0)
            <span class='exception'>You don't have any favorite locations yet; would you like to <a href='/locations/new'>add one</a></span>?
        @else
            @foreach($locations as $location)
                <ul>
                    @if( $location->state !=null)
                        <li class='truncate'><a href='locations/show/{{ $location->id }}'>{{ $location->city }}, {{ $location->state }}, {{ $location->country }}</a> ...updated {{ $location->updated_at->diffForHumans()}}</li>
                    @else
                        <li class='truncate'><a href='locations/show/{{ $location->id }}'>{{ $location->city }}, {{ $location->country }}</a> ...updated {{ $location->updated_at->diffForHumans()}}</li>
                    @endif
                </ul>
            @endforeach
        @endif
    </section>

@endsection
