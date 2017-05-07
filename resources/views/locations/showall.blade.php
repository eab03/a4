@extends('layouts.master')

@section('content')

<section id='locationsShow' class='cf'>
    <h1>Your Cities</h1>
    <hr>

    @if(count($locations) == 0)
        You don't have any favorite places yet; would you like to <a href='/locations/new'>add one</a>?
    @else
        @foreach($locations as $location)

            <div class='location cf'>
                <ul>
                    <li>
                        <a href='/locations/show/{{ $location->id }}'><h3>{{ $location->city }}, {{ $location->state }}, {{ $location->country}}</h3></a>
                        <a href='/locations/show/{{ $location->id }}'><img class='imgShowAll' src='{{ $location->location_image }}' alt='Image {{ $location->city }}'></a>

                        <a class='locationAction' href='/locations/edit/{{ $location->id }}'><i class='fa fa-pencil'></i></a>
                        <a class='locationAction' href='/locations/show/{{ $location->id }}'><i class='fa fa-eye'></i></a>
                        <a class='locationAction' href='/locations/delete/{{ $location->id }}'><i class='fa fa-trash'></i></a>
                    </li>
                </ul>
            </div>
        @endforeach
    @endif
</section>

@endsection
