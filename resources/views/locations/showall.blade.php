@extends('layouts.master')

@section('title')
    Show All Locations
@endsection

@section('content')

    <section class='top'><!--new section-->
        <div class='row'><!--new bootstrap row-->
            <div class='col-sm-7 col-md-8 col-lg-8'>
                <h1>Favorite Locations</h1>
            </div>
            <div class='col-sm-5 col-md-4 col-lg-4'>
                <a href='/locations/new'><h3>Add a New Location!<h3></a>
            </div>
        </div><!--close bootstrap row-->
        <hr>
    </section><!--close sectino top-->

    <section class='locations'><!--new section-->
        <div class='row'><!--new bootstrap row-->
            <div class='col-sm-12 col-md-12 col-lg-12'>

                @if(count($locations) == 0)
                    <div class='exception'>
                        You don't have any favorite locations yet; would you like to <a href='/locations/new'>add one</a>?
                    </div>
                @else
                    @foreach($locations as $location)
                        <div class='col-sm-4 col-md-4 col-lg-4'>
                            <div class="locationnames">

                                @if($location->state != null)
                                    <a href='/locations/show/{{ $location->id }}'><h3>{{ $location->city }}, {{ $location->state }}, {{ $location->country }}</h3></a>
                                @else($location->state = null)
                                    <a href='/locations/show/{{ $location->id }}'><h3>{{ $location->city }}, {{ $location->country }}</h3></a>
                                @endif

                                <a href='/locations/show/{{ $location->id }}'><img class='img-all' src='{{ $location->location_image }}' alt='Image for {{ $location->city }}'></a>

                                <a class='locationAction' href='/locations/edit/{{ $location->id }}'><i class='fa fa-pencil'></i></a>
                                <a class='locationAction' href='/locations/show/{{ $location->id }}'><i class='fa fa-eye'></i></a>
                                <a class='locationAction' href='/locations/delete/{{ $location->id }}'><i class='fa fa-trash'></i></a>
                                <br><br>
                                <hr>
                            </div>
                        </div>
                    @endforeach
                @endif

            </div>
        </div><!-- close boostrap row-->

@endsection
