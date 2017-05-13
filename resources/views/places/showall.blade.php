@extends('layouts.master')

@section('title')
    Show All Places
@endsection

@section('content')

    <div class='container'>

        <div class='row top'>
            <div class='col-sm-4 col-md-6 col-lg-6'>
                <h1>Favorite Places</h1>
            </div>
            <div class='col-sm-4 col-md-2 col-lg-3'>
                <a href='/places/search'><input type='button' value='Search for a Place!' class='btn btn-primary btn-small'></a>
            </div>
            <div class='col-sm-4 col-md-2 col-lg-3'>
                <a href='/places/new'><input type='button' value='Add a New Place!' class='btn btn-primary btn-small'></a>
            </div>
        </div><!--close bootstrap row-->
        <hr>

        @if(count($places) == 0)
            <p><span class='exception'>You don't have any favorite places yet; would you like to <a href='/places/new'>add one?</a></span></p>
        @else

             @foreach($places as $place)

                <div class='row'>
                    <div class='col-sm-6 col-md-6 col-lg-8'>
                        <h3><a href='/places/show/{{ $place->id }}'>{{ $place->name }}</h3></a>
                    </div>
                </div><!--close bootstrap row-->

                <div class='row'>
                    <div class='col-sm-6 col-md-6 col-lg-8'>
                        <a href='/places/show/{{ $place->id }}'><img class='imgShowAll' src='{{ $place->place_image }}' alt='Image {{ $place->name }}'></a>

                        <a class='placeAction' href='/places/edit/{{ $place->id }}'><i class='fa fa-pencil'></i></a>
                        <a class='locationAction' href='/places/show/{{ $place->id }}'><i class='fa fa-eye'></i></a>
                        <a class='placeAction' href='/places/delete/{{ $place->id }}'><i class='fa fa-trash'></i></a>

                        <br><br>
                        <p><a href='{{ $place->place_link }}'>Website</a><p>

                        @if( $place->location->state !=null)
                            <p class='bold'>{{ $place->location->city }}, {{ $place->location->state }}, {{ $place->location->country }}</p>
                        @else
                            <p class='bold'>{{ $place->location->city }}, {{ $place->location->country }}</p>
                        @endif

                        <p>Last updated:</span> {{ $place->updated_at->diffForHumans() }}</p>
                        <br>
                    </div>

                    <div class='col-sm-6 col-md-6 col-lg-4'>
                        <div class='notes'>
                            <p><span class='bold'>Notes:<span class='bold'> {{ $place->place_notes }}</p>
                        </div>
                    </div>
                    <hr>

                </div><!--close bootstrap row-->

            @endforeach
        @endif

    </div><!--close div container-->

@endsection
