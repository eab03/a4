@extends('layouts.master')

@section('title')
    Show One Place
@endsection

@section('content')

    <div class='container'>

        <div class='row top'>
            <div class='col-sm-8 col-md-9 col-lg-9'>
                <h1>{{ $place->name }}</h1>
            </div>
            <div class='col-sm-4 col-md-3 col-lg-3'>
                <a href='/places/showall'><input type='button' value='Show All Places' class='btn btn-primary btn-small'></a>
            </div>
        </div><!--close bootstrap row-->
        <hr>

        <div class='row'>
            <div class='col-sm-6 col-md-6 col-lg-8'>
                <img class='imgShowOne' src='{{ $place->place_image }}' alt='Image {{ $place->name }}'>

                <a class='placeAction' href='/places/edit/{{ $place->id }}'><i class='fa fa-pencil'></i></a>
                <a class='placeAction' href='/places/delete/{{ $place->id }}'><i class='fa fa-trash'></i></a>

                <br><br>

                <p><a href='{{ $place->place_link }}'>Website</a></p>

                @if( $place->location->state !=null)
                    <p class='bold'>{{ $place->location->city }}, {{ $place->location->state }}, {{ $place->location->country }}</p>
                @else
                    <p class='bold'>{{ $place->location->city }}, {{ $place->location->country }}</p>
                @endif

                <p>Added on: {{ $place->created_at }}</p>
                <p>Last updated: {{ $place->updated_at }}</p>

                <p>Tags:
                    @foreach($tagsForThisPlace as $id => $name)
                        {{ $name }} &nbsp
                    @endforeach
                </p>

            </div>

            <div class='col-sm-6 col-md-6 col-lg-4'>
                <div class='notes'>
                    <p><span class='bold'>Notes:</span> {{ $place->place_notes }}</p>
                </div>
            </div>

        </div><!--close bootstrap row-->

    </div><!--close container-->

@endsection
