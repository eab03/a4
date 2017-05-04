@extends('layouts.master')

@section('content')

<section id='locationsShow' class='cf'>
    <h2>Your Cities</h2>

            <div class='location cf'>
                <ul>
                    <li>
                        <a href='/locations/show/{id}{{ $location->id }}'><h3>{{ $location->city }}, {{ $location->state }}, {{ $location->country}}</h3></a>
                        <a href='/locations/show/{id}{{ $location->id }}'><img class='locationImg' src='{{ $location->location_image }}' alt='Image {{ $location->city }}'></a>

                        <a class='locationAction' href='/location/edit/{{ $location->id }}'><i class='fa fa-pencil'></i></a>
                        <a class='locationAction' href='/location/show{{ $location->id }}'><i class='fa fa-eye'></i></a>
                        <a class='locationAction' href='/location/delete/{{ $location->id }}'><i class='fa fa-trash'></i></a>
                    </li>
                </ul>
            </div>
</section>

@endsection
