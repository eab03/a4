@extends('layouts.master')

@section('title')
    Search
@endsection

@section('content')
    <h1>Search</h1>

    <form method='GET' action='/places/search'>

        <label for='searchPlace'>Title</label>
        <input type='text' name='searchPlace' id='searchPlace' value='{{ $searchPlace or '' }}'>
        <br>
        <input type='checkbox' name='caseSensitive' {{ ($caseSensitive) ? 'CHECKED' : '' }} >
        <label>case sensitive</label>

        <br><br>
        <input type='submit' value='Search' class='btn btn-primary btn-small'>

    </form>

    @if($searchPlace != null)
        <h2>Results for query: <em>{{ $searchPlace }}</em></h2>

        @if(count($searchResults) == 0)
            No matches found.
        @else

            @foreach($searchResults as $place_name => $place)
                <div class='place'>
                    <h3>{{ $place_name }}</h3>
                    <img src='{{ $place['place_image']}}'>
                </div>
            @endforeach

        @endif
    @endif
@endsection
