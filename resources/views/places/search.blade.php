@extends('layouts.master')

@section('title')
    Search
@endsection

@section('content')
    <div class="top">
        <h1>Search Places</h1>
        <hr>
    </div>

    <form method='GET' action='/places/search'>

        <div class="form-group text-entry">
            <label for='searchPlace' class="control-label">Place Name</label>
            <input type='text' class="form-control" name='searchPlace' id='searchPlace' placeholder="Crema Cafe" value='{{ $searchPlace or '' }}'>
        </div>

        <div class="form-check checkbox">
            <input type='checkbox' class="form-check-input" name='caseSensitive' value='{{ ($caseSensitive) ? 'CHECKED' : '' }}'>
            <label for='caseSenstive' class="form-check-label">Case Sensitive</label>
        </div>

        <input type='submit' value='Search' class='btn btn-primary btn-small'>
        <a href="/places/showall"><input type='button' value='Help! Search All Places!' class='btn btn-info  btn-small'></a>

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

    </form>

@endsection
