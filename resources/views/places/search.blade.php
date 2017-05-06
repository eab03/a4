@extends('layouts.master')

@section('title')
    Search
@endsection

@section('content')
    <h1>Search Places</h1>
    <hr>

    <form method='GET' action='/places/search'>

        <h2>Search for a Place</h2>
        <label for='searchPlace'>Place Name</label>
        <input type='text' name='searchPlace' id='searchPlace' value='{{ $searchPlace or '' }}'>
        <br>
        <input type='checkbox' name='caseSensitive' {{ ($caseSensitive) ? 'CHECKED' : '' }} >
        <label>case sensitive</label>

        <br>

        <input type='submit' value='Search for a Place' class='btn btn-primary btn-small'>

        <h2>Search all Places</h2>
        <a href="/places/showall"><input type='button' value='Search All Places' class='btn btn-primary btn-small'></a>

        @if($searchPlace != null)
            <h2>Results for query: <em>{{ $searchPlace }}</em></h2>

            @if(count($searchResults) == 0)
                No matches found.
            @else

                @foreach($searchResults as $name => $place)
                    <div class='place'>
                        <h3>{{ $name }}</h3>
                        <img src='{{ $place['place_image']}}'>
                        <p>{{ $place['location']}}<p>
                        <a href='{{ $place['place_link'] }}'>Website</a></p>
                    </div>
                @endforeach

            @endif
        @endif

        <br><br>

    </form>


@endsection
