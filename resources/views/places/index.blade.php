@extends('layouts.master')

@section('title')
    Recent Places and Locations
@endsection

@section('content')

    <section class='top'><!--new section-->
        <div class='row'><!--new bootstrap row-->
            <div class='col-sm-12 col-md-12 col-lg-12'>
                <h1>My Recent Places and Locations</h1>
            </div>
        </div><!--close bootstrap row-->
        <hr>
    </section><!--close section top-->

    <section id='newPlaces'><!--new section-->
        <div class='row'><!--new bootstrap row-->
            <div class='col-sm-12 col-md-12 col-lg-12'>
                <h2>Updated
                    Places</h2>
                <br>
                @if(count($newPlaces) == 0)
                    <div class='exception'>
                        You don't have any favorite places yet; would you like to <a href='/places/new'>add one</a>?
                    </div>
                @else
                    <ul>
                    @foreach($newPlaces as $place)
                        <li class='truncate'><i class='fa fa-star'></i>&nbsp &nbsp &nbsp<a href='places/show/{{ $place->id }}'>{{ $place->name }}</a> &nbsp updated {{ $place->updated_at->diffForHumans() }}</li>
                    @endforeach
                    </ul>
                @endif
            </div>
        </div><!--close bootstrap row-->
        <br>
    </section> <!--close section newPlaces-->

    <section id='newLocations'><!--new section-->
        <div class='row'><!--new bootstrap row-->
            <div class='col-sm-12 col-md-12 col-lg-12'>
                <h2>New Locations</h2>
                @if(count($locations) == 0)
                    <div class='exception'>
                        You don't have any favorite locations yet; would you like to <a href='/locations/new'>add one?</a>
                    </div>
                @else
                    <div class='row'><!--new bootstrap row-->
                        @foreach($locations as $location)
                            <div class='col-sm-4 col-md-4 col-lg-4'>

                                <div id="locationnames">
                                    @if($location->state != null)
                                        <a href='/locations/show/{{ $location->id }}'><h3>{{ $location->city }}, {{ $location->state }}, {{ $location->country }}</h3></a>
                                    @else($location->state = null)
                                        <a href='/locations/show/{{ $location->id }}'><h3>{{ $location->city }}, {{ $location->country }}</h3></a>
                                    @endif
                                </div>

                                <a href='/locations/show/{{ $location->id }}'><img class='img-all' src='{{ $location->location_image }}' alt='Image {{ $location->city }}'></a>

                                <a class='locationAction' href='/locations/edit/{{ $location->id }}'><i class='fa fa-pencil'></i></a>
                                <a class='locationAction' href='/locations/show/{{ $location->id }}'><i class='fa fa-eye'></i></a>
                                <a class='locationAction' href='/locations/delete/{{ $location->id }}'><i class='fa fa-trash'></i></a>
                                <br>
                                <p>Created: {{ $location->created_at->diffForHumans() }}<p>
                                <hr>

                            </div>
                        @endforeach
                    </div><!--close bootstrap row-->
                @endif
            </div>
        </div><!--close bootstrap row-->
    </section><!--close section newLocations-->

@endsection
