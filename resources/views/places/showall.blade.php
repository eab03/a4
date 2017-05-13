@extends('layouts.master')

@section('title')
    Show All Places
@endsection

@section('content')

    <section class='top'>
        <div class='row'>
            <div class='col-sm-5 col-md-5 col-lg-5'>
                <h1>Favorite Places</h1>
            </div>
            <div class='col-sm-7 col-md-7 col-lg-7'>
                <div class="floatRight">
                    <a href='/places/search'><input type='button' value='Search for a Place!' class='btn btn-info'></a>&nbsp &nbsp &nbsp &nbsp
                    <a href='/places/new'><input type='button' value='Add a New Place!' class='btn btn-primary'></a>
                </div>
            </div>
        </div><!--close bootstrap row-->
        <hr>
    </section><!--close section top-->

    <section class='places'>

        @if(count($places) == 0)
            <div class='row'>
                <div class='col-sm-12 col-md-12 col-lg-12'>
                    <div class='exception'>
                        You don't have any favorite places yet; would you like to <a href='/places/new'>add one?</a>
                    </div>
                </div>
            </div><!--close bootstrap row-->
        @else

            <div class='row'>
                @foreach($places as $place)
                    <div class='col-sm-6 col-md-6 col-lg-6'>
                        <div id="placenames">
                            <a href='/places/show/{{ $place->id }}'><h3>{{ $place->name }}</h3></a>
                            <a href='/places/show/{{ $place->id }}'><img class='imgShowAll' src='{{ $place->place_image }}' alt='Image {{ $place->name }}'></a>

                            <a class='placeAction' href='/places/edit/{{ $place->id }}'><i class='fa fa-pencil'></i></a>
                            <a class='placeAction' href='/places/show/{{ $place->id }}'><i class='fa fa-eye'></i></a>
                            <a class='placeAction' href='/places/delete/{{ $place->id }}'><i class='fa fa-trash'></i></a>

                            <br><br>
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

            </div><!--close bootstrap row-->

        @endif

    </section><!--close section places-->

@endsection
