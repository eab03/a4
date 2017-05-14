@extends('layouts.master')

@section('title')
    Search Places
@endsection

@section('content')

    <section class='top'>
        <div class='row'><!--new bootstrap row-->
            <div class='col-sm-12 col-md-12 col-lg-12'>
                <h1>Search Places</h1>
            </div>
        </div><!--close bootstrap row-->
        <hr>
    </section><!--close section top-->

    <!--form for searching for a place-->
    <section class='form'>
        <div class='row'><!--new bootstrap row-->
            <div class='col-sm-12 col-md-12 col-lg-12'>

                <form method='GET' action='/places/search'>

                    <div class='form-group text-entry'>
                        <label for='searchPlace' class='control-label'>Place Name</label>
                        <input type='text' class='form-control' name='searchPlace' id='searchPlace' placeholder='Crema Cafe' value='{{ $searchPlace or '' }}'>
                    </div>

                    <div class='form-check checkbox'>
                        <label><input type='checkbox' class='form-check-input' name='caseSensitive' {{ ($caseSensitive) ? 'CHECKED' : '' }}>Case Sensitive</label>
                    </div>
                    <br><br>

                    <input type='submit' value='Search' class='btn btn-primary'>&nbsp &nbsp &nbsp &nbsp
                    <a href='/places/showall'><input type='button' value='Go Back to All Places' class='btn btn-info'></a>

                </form><!--close form-->

            </div>
        </div><!--close bootstrap row-->
    </section><!--close section form-->

    <!--display query results-->
    <section class='places'><!--new section-->
        <div class='row'><!--new bootstrap row-->
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
                        <div class='col-sm-6 col-md-6 col-lg-6'>
                            @foreach($searchResults as $name => $place)
                                @foreach($locations as $location)

                                @if($place['location'] == $location->city)
                                    <img class='img-one' src='{{ $place['place_image'] }}'>
                                    <br>

                                    @if( $location->state !=null)
                                        <p class="results"><strong>{{ $location->city }}, {{ $location->state }}, {{ $location->country }}</strong></p>
                                    @else
                                        <p class="results">{{ $location->city }}, {{ $location->country }}</strong></p>
                                    @endif

                                    <a class="results" href='{{ $place['place_link'] }}'>Website</a>
                                </div>

                                <div class='col-sm-6 col-md-6 col-lg-6'>
                                    <div class='notes'>
                                        <p><strong>Notes:</strong> {{ $place['place_notes'] }}</p>
                                    </div>
                                </div>

                                @break;
                                @endif

                            @endforeach
                        @endforeach
                    @endif
                @endif
            <div>
        </div><!--close bootstrap row-->
    </section><!--close section places-->

@endsection
