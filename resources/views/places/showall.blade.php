@extends('layouts.master')

@section('title')
    Show All Places
@endsection

@section('content')

    <section class='top'><!--new section-->
        <div class='row'><!--new bootrap row-->
            <div class='col-sm-7 col-md-8 col-lg-8'>
                <h1>Favorite Places</h1>
            </div>
            <div class='col-sm-5 col-md-4 col-lg-4'>
                <a href='/places/new'><h3>Add a New Place!<h3></a>
            </div>
        </div><!--close bootstrap row-->
        <hr>
    </section><!--close section top-->

    <section class='places'><!--new section-->
        <div class='row'><!--new bootstrap row-->
            @if(count($places) == 0)
                <div class='col-sm-12 col-md-12 col-lg-12'>
                    <div class='exception'>
                        You don't have any favorite places yet; would you like to <a href='/places/new'>add one</a>?
                    </div>
                </div>
            @else
                @foreach($places as $place)
                    <div class='col-sm-4 col-md-4 col-lg-4'>
                        <div class="placenames">

                            <a href='/places/show/{{ $place->id }}'><h3>{{ $place->name }}</h3></a>
                            <a href='/places/show/{{ $place->id }}'><img class='img-all' src='{{ $place->place_image }}' alt='Image for {{ $place->name }}'></a>

                            <a class='placeAction' href='/places/edit/{{ $place->id }}'><i class='fa fa-pencil'></i></a>
                            <a class='placeAction' href='/places/show/{{ $place->id }}'><i class='fa fa-eye'></i></a>
                            <a class='placeAction' href='/places/delete/{{ $place->id }}'><i class='fa fa-trash'></i></a>
                            <br>

                            @if( $place->location->state !=null)
                                <p>{{ $place->location->city }}, {{ $place->location->state }}, {{ $place->location->country }}</p>
                            @else
                                <p>{{ $place->location->city }}, {{ $place->location->country }}</p>
                            @endif

                            <a href='{{ $place->place_link }}'>Website</a>
                            <br><br>
                            <hr>

                        </div>
                    </div>
                @endforeach
            @endif
        </div><!--close bootstrap row-->
    </section><!--close section places-->

@endsection
