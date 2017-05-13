@extends('layouts.master')

@section('title')
    Show All Locations
@endsection

@section('content')

<section id='locationsShow' class='cf'>
    <div class="top">
        <h1>Favorite Locations</h1>
        <a href="/locations/new"><input type='button' value='Add a New Location!' class='btn btn-primary btn-small'></a>
        <hr>
    </div>

    @if(count($locations) == 0)
        You don't have any favorite places yet; would you like to <a href='/locations/new'>add one</a>?
    @else
        @foreach($locations as $location)

            <div class='location cf'>

                @if($location->state != null)
                    <a href='/locations/show/{{ $location->id }}'><h3>{{ $location->city }}, {{ $location->state }}, {{ $location->country}}</h3></a>
                @else($location->state = null)
                    <a href='/locations/show/{{ $location->id }}'><h3>{{ $location->city }}, {{ $location->country}}</h3></a>
                @endif

                <a href='/locations/show/{{ $location->id }}'><img class='imgShowAll' src='{{ $location->location_image }}' alt='Image {{ $location->city }}'></a>

                <a class='locationAction' href='/locations/edit/{{ $location->id }}'><i class='fa fa-pencil'></i></a>
                <a class='locationAction' href='/locations/show/{{ $location->id }}'><i class='fa fa-eye'></i></a>
                <a class='locationAction' href='/locations/delete/{{ $location->id }}'><i class='fa fa-trash'></i></a>
            </div>
            <br>
            <hr>
        @endforeach
    @endif
</section>

@endsection
