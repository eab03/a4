@extends('layouts.master')

@section('title')
    Show One Location
@endsection

@section('content')

    <section class='top'>
        <div class='row'>
            <div class='col-sm-7 col-md-8 col-lg-9'>
                @if( $location->state !=null)
                    <h1>{{ $location->city }}, {{ $location->state }}, {{ $location->country }}</h1>
                @else
                    <h1>{{ $location->city }}, {{ $location->country }}</h1>
                @endif
            </div>
            <div class='col-sm-5 col-md-5 col-lg-3'>
                <a href='/locations/showall'><input type='button' value='Show all Locations' class='btn btn-primary btn-small'></a>
            </div>
        </div><!-- close bootstrap row-->
        <hr>
        <br>
    </section><!--close section top-->


    <section class='locations'>
        <div class='row'>
            <div class='col-sm-12 col-md-12 col-lg-12'>
                <img class='imgShowOne' src='{{ $location->location_image }}' alt='Image {{ $location->city }}'>

                <a class='locationAction' href='/locations/edit/{{ $location->id }}'><i class='fa fa-pencil'></i></a>
                <a class='locationAction' href='/locations/delete/{{ $location->id }}'><i class='fa fa-trash'></i></a>
            </div>
        </div><!--close bootstrap row-->

    </section>

@endsection
