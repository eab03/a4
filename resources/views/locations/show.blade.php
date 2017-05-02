@extends('layouts.master')

@section('content')

<section id='locationsShow' class='cf'>
    <h2>Your Cities</h2>
    @if(count($locations) == 0)
        You don't have any favorite places yet; would you like to <a href='/locations/new'>add one</a>?
    @else
        @foreach($locations as $location)

            <div class='location cf'>
                <ul>
                    <li class='horizontal'>
                        <a href='/locations/show{{ $location->id }}'><img class='locationImg' src='{{ $location->location_image }}' alt='Image {{ $location->city }}'></a>
                        <a href='/locations/show{{ $location->id }}'><h3>{{ $location->city }}, {{ $location->state }}</h3></a>

                        <a class='locationAction' href='/location/edit/{{ $location->id }}'><i class='fa fa-pencil'></i></a>
                        <a class='locationAction' href='/location/show{{ $location->id }}'><i class='fa fa-eye'></i></a>
                        <a class='locationAction' href='/location/delete/{{ $location->id }}'><i class='fa fa-trash'></i></a>
                    </li>
                </ul>
            </div>
        @endforeach
    @endif
</section>

@endsection
