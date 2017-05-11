@extends('layouts.master')

@section('content')

    <div class='place cf'>

        <div class="top">
            <h1>{{ $place->name }}</h1>
            <a href="/places/showall"><input type='button' id="btnRight" value='Show All Places' class='btn btn-primary btn-small'></a>
        <hr>

            <div class='place'>

                <div class="placeRight">
                    <p>Notes: {{ $place->place_notes}} </p>
                </div>

                <div class="placeLeft">
                    <img class='imgShowOne' src='{{ $place->place_image }}' alt='Image {{ $place->name }}'>

                    <a class='placeAction' href='/places/edit/{{ $place->id }}'><i class='fa fa-pencil'></i></a>
                    <a class='placeAction' href='/places/delete/{{ $place->id }}'><i class='fa fa-trash'></i></a>

                    <br><br>

                    <p><a href='{{ $place->place_link }}'>Website</a></p>

                    <p>{{ $place->location->city }}, {{ $place->location->state}}, {{ $place->location->country}}</p>
                    <p>Added on: {{ $place->created_at }}</p>
                    <p>Last updated: {{ $place->updated_at }}</p>
                    <p>Tags:
                        @foreach($tagsForThisPlace as $id => $name)
                            {{ $name }} &nbsp
                        @endforeach
                    </p>

                </div>

            </div>
    </div>

@endsection
