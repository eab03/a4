@extends('layouts.master')

@section('title')
    Show All Locations
@endsection

@section('content')

    <div class='container'>

        <div class='row top'>
            <div class='col-sm-8 col-md-9 col-lg-9'>
                <h1>Favorite Locations</h1>
            </div>
            <div class='col-sm-4 col-md-3 col-lg-3'>
                <a href='/locations/new'><input type='button' value='Add a New Location!' class='btn btn-primary btn-small'></a>
                <hr>
            </div>
        </div><!--close bootstrap row-->
        <hr>

        <div class='location'>

            @if(count($locations) == 0)
                <p class='exception'>You don't have any favorite places yet; would you like to <a href='/locations/new'>add one</a>?</p>
            @else
                @foreach($locations as $location)
                    @if($location->state != null)
                        <a href='/locations/show/{{ $location->id }}'><h3>{{ $location->city }}, {{ $location->state }}, {{ $location->country }}</h3></a>
                    @else($location->state = null)
                        <a href='/locations/show/{{ $location->id }}'><h3>{{ $location->city }}, {{ $location->country }}</h3></a>
                    @endif

                    <a href='/locations/show/{{ $location->id }}'><img class='imgShowAll' src='{{ $location->location_image }}' alt='Image {{ $location->city }}'></a>

                    <a class='locationAction' href='/locations/edit/{{ $location->id }}'><i class='fa fa-pencil'></i></a>
                    <a class='locationAction' href='/locations/show/{{ $location->id }}'><i class='fa fa-eye'></i></a>
                    <a class='locationAction' href='/locations/delete/{{ $location->id }}'><i class='fa fa-trash'></i></a>
                    <br>
                    <hr>

                @endforeach
            @endif

        </div><!-- close div location-->

    </div><!-- close div content-->

@endsection
