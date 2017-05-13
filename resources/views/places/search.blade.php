@extends('layouts.master')

@section('title')
    Search Places
@endsection

@section('content')

    <section class='top'>
        <div class='row'>
            <div class='col-sm-8 col-md-9 col-lg-9'>
                <h1>Search Places</h1>
            </div>
            <div class='col-sm-4 col-md-3 col-lg-3'>
                <a href='/places/showall'><input type='button' value='Show All Places' class='btn btn-primary btn-small'></a>
            </div>
        </div><!--close bootstrap row-->
        <hr>
    </section>

    <!--form for searching for a place-->
    <div class='row'>
        <div class='col-sm-12 col-md-12 col-lg-12'>

            <form method='GET' action='/places/search'>

                <div class='form-group text-entry'>
                    <label for='searchPlace' class='control-label'>Place Name</label>
                    <input type='text' class='form-control' name='searchPlace' id='searchPlace' placeholder='Crema Cafe' value='{{ $searchPlace or '' }}'>
                </div>

                <div class='form-check checkbox'>
                    <input type='checkbox' class='form-check-input' name='caseSensitive' value='{{ ($caseSensitive) ? 'CHECKED' : '' }}'>
                    <label for='caseSenstive' class='form-check-label'>Case Sensitive</label>
                </div>

                <input type='submit' value='Search' class='btn btn-primary btn-small'>

            </form><!--close form-->

        </div>
    </div><!--close div row-->

    <!--display query results-->
    <div class='row'>
        <div class='col-sm-12 col-md-12 col-lg-12'>

            @if($searchPlace != null)
                <hr>
                <h2>Results for query: <em>{{ $searchPlace }}</em></h2>
                <br>

                @if(count($searchResults) == 0)
                    <div class='exception'>
                        No matches found.
                    </div>
                @else

                    @foreach($searchResults as $name => $place)
                        <section class='places' id='queryResults'>
                            <img src='{{ $place['place_image'] }}'>
                                <br><br>
                                <a href='{{ $place['place_link'] }}'>Website</a></p>
                        </section>
                    @endforeach

                @endif
            @endif

        <div>
    </div>

@endsection
