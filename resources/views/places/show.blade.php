@extends('layouts.master')

@section('content')

    <div class='place cf'>

        <h1></h1>
        <hr>

            <h2>{{ $place->name }}</h2>
            <h3>{{ $place->location->city }}, {{ $place->location->state}}, {{ $place->location->country}}</h3>

            <div class='place'>

                <div class="placeRight">
                    <p>Notes: </p>
                </div>

                <div id="placeLeft">
                    <img class='imgShowOne' src='{{ $place->place_image }}' alt='Image {{ $place->name }}'>

                    <a class='placeAction' href='/places/edit/{{ $place->id }}'><i class='fa fa-pencil'></i></a>
                    <a class='placeAction' href='/places/delete/{{ $place->id }}'><i class='fa fa-trash'></i></a>

                    <br><br>
                    <p><a href='{{ $place->place_link }}'>Website</a></p>

                    <p>Added on: {{ $place->created_at }}</p>
                    <p>Last updated: {{ $place->updated_at }}</p>
                    <p>Tags:
                        @foreach($tagsForThisPlace as $id => $name)
                            {{ $name }} &nbsp
                        @endforeach
                    </p>

                </div>

            </div>
        <a href="/places/showall"><input type='button' id="btnRight" value='Show All Places' class='btn btn-primary btn-small'></a>

    </div>

@endsection
