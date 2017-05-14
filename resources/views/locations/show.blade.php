@extends('layouts.master')

@section('title')
    Show One Location
@endsection

@section('content')

    <section class='top'><!--new section-->
        <div class='row'><!--new bootstrap row-->
            <div class='col-sm-12 col-md-12 col-lg-12'>
                @if( $location->state !=null)
                    <h1>{{ $location->city }}, {{ $location->state }}, {{ $location->country }}</h1>
                @else
                    <h1>{{ $location->city }}, {{ $location->country }}</h1>
                @endif
            </div>
        </div><!-- close bootstrap row-->
        <hr>
    </section><!--close section top-->

    <div class='locations'>
        <div class='row'><!--new bootstrap row-->
            <div class='col-sm-6 col-md-6 col-lg-6'>

                <img class='img-one' src='{{ $location->location_image }}' alt='Image for {{ $location->city }}'>

                <a class='locationAction' href='/locations/edit/{{ $location->id }}'><i class='fa fa-pencil'></i></a>
                <a class='locationAction' href='/locations/delete/{{ $location->id }}'><i class='fa fa-trash'></i></a>
                <br>

                <p>Added: {{ $location->created_at->diffForHumans() }}</p>
                <p>Last updated: {{ $location->updated_at->diffForHumans() }}</p>
            </div>

            <div class='col-sm-6 col-md-6 col-lg-6'>
                <div class='notes'>
                    <p><strong>Notes:</strong> {{ $location->location_notes }}</p>
                </div>
            </div>

        </div><!--close bootstrap row-->
    </div><!--close section locations-->

@endsection
