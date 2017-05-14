@extends('layouts.master')

@section('title')
    Show One Place
@endsection

@section('content')

    <section class='top'>
        <div class='row'>
            <div class='col-sm-12 col-md-12 col-lg-12'>
                <h1>{{ $place->name }}</h1>
            </div>
        </div><!--close bootstrap row-->
        <hr>
    </section><!--close section top-->

    <section class='places' id='oneplace'>
        <div class='row'>
            <div class='col-sm-6 col-md-6 col-lg-6'>
                <img class='imgShowOne' src='{{ $place->place_image }}' alt='Image {{ $place->name }}'>

                <a class='placeAction' href='/places/edit/{{ $place->id }}'><i class='fa fa-pencil'></i></a>
                <a class='placeAction' href='/places/delete/{{ $place->id }}'><i class='fa fa-trash'></i></a>

                <br><br>
                <a href='{{ $place->place_link }}'>Website</a>
                <br><br>

                @if( $place->location->state !=null)
                    <p> Location: {{ $place->location->city }}, {{ $place->location->state }}, {{ $place->location->country }}</p>
                @else
                    <p> Location: {{ $place->location->city }}, {{ $place->location->country }}</p>
                @endif

                <p>Added: {{ $place->created_at->diffForHumans() }}</p>
                <p>Last updated: {{ $place->updated_at->diffForHumans() }}</p>

                <p>Tags:
                    @foreach($tagsForThisPlace as $id => $name)

                        {{ $name }} &nbsp
                    @endforeach
                </p>
                <br>

            </div>

            <div class='col-sm-6 col-md-6 col-lg-6'>
                <div class='notes'>
                    <p><strong>Notes:</strong> {{ $place->place_notes }}</p>
                </div>
            </div>

        </div><!--close bootstrap row-->

    </section><!--close section places-->

@endsection
