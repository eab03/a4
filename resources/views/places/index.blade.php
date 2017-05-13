@extends('layouts.master')

@section('title')
    Recent Places and Locations
@endsection

@section('content')

    <section class='top'>
        <div class='row'>
            <div class='col-sm-12 col-md-12 col-lg-12'>
                <h1>My Recent Places and Locations</h1>
            </div>
        </div><!--close bootstrap row-->
        <hr>
    </section><!--close section top-->

    <section id='newPlaces'>
        <div class='row'>
            <div class='col-sm-12 col-md-12 col-lg-12'>

                <h2>Places</h2>

                @if(count($newPlaces) == 0)
                    <div class='exception'>
                        You don't have any favorite places yet; would you like to <a href='/places/new'>add one?</a>
                    </div>
                @else
                    @foreach($newPlaces as $place)
                        <ul>
                            <li class='truncate'><a href='places/show/{{ $place->id }}'>{{ $place->name }}</a> ...updated {{ $place->updated_at->diffForHumans() }}</li>
                        </ul>
                    @endforeach
                @endif

            </div>
        </div><!--close bootstrap row-->

    </section> <!-- close section newPlaces-->

    <section id='newLocations'>
        <div class='row'>
            <div class='col-sm-12 col-md-12 col-lg-12'>

                <h2>Locations</h2>

                @if(count($locations) == 0)
                    <p class='exception'>You don't have any favorite locations yet; would you like to <a href='/locations/new'>add one?</a></p>
                @else
                    @foreach($locations as $location)
                        <ul>
                            @if( $location->state !=null)
                                <li class='truncate'><a href='locations/show/{{ $location->id }}'>{{ $location->city }}, {{ $location->state }}, {{ $location->country }}</a> ...updated {{ $location->updated_at->diffForHumans()}}</li>
                            @else
                                <li class='truncate'><a href='locations/show/{{ $location->id }}'>{{ $location->city }}, {{ $location->country }}</a> ...updated {{ $location->updated_at->diffForHumans()}}</li>
                            @endif
                        </ul>
                    @endforeach
                @endif

            </div>
        </div><!--close bootstrap row-->

    </section><!-- close section newLocations-->

@endsection
