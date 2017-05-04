@extends('layouts.master')

@section('content')

    <section id='locationsShow' class='cf'>
        <h2>Your Cities</h2>

                <div class='location cf'>
                    <h3>{{ $location->city }}, {{ $location->state }}, {{ $location->country}}</h3>
                    <a href='locations/show{{ $location->id }}'><img class='locationImg' src='{{ $location->location_image }}' alt='Image {{ $location->city }}'></a>

                    <a class='locationAction' href='locations/edit/{{ $location->id }}'><i class='fa fa-pencil'></i></a>
                    <a class='locationAction' href='locations/delete/{{ $location->id }}'><i class='fa fa-trash'></i></a>
                </div>
    </section>

@endsection
