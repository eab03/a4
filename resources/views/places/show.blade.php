@extends('layouts.master')

@section('content')

    <section>
        <h2>My Favorite Places!</h2>
        <ul>
            @foreach($places as $place)
                <li class='truncate'><a href='/places/show{{ $place->id }}'>{{ $place->place_name }} </a> located in <a href='/locations/show{{ $place->id }}'>{{ $place->location->city }}, {{ $place->location->state }}</a> added {{ $place->created_at->diffForHumans()}}</li>
            @endforeach
        </ul>
    </section>

@endsection
