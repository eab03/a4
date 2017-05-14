@extends('layouts.master')

@section('title')
    Edit Locations
@endsection

@section('content')

    <section class='top'><!--new section-->
        <div class='row'><!--new bootstrap row-->
            <div class='col-sm-12 col-md-12 col-lg-12'>

                @if( $location->state !=null)
                    <h1>{{ $location->city }}, {{ $location->state }}, {{ $location->country }}</h1>
                @else
                    <h1>{{ $location->city }}, {{ $location->country }}</h1>
                @endif

            </div>
        </div><!--close bootstrap row-->
        <hr>
    </section><!--close section top-->

    <!--form for editing a single location-->
    <div class='form'><!--new div-->
        <div class='row'><!--new bootstrap row-->
            <div class='col-sm-12 col-md-12 col-lg-12'>

                <form method='POST' action='/locations/edit'>
                    {{ csrf_field() }}

                    <div class="form-group text-entry">

                        <small>* Required fields</small>
                        <br><br>

                        <input type='hidden' name='id' value='{{ $location->id }}'>

                        <label for='city' class="control-label">* City</label>
                        <input type='text' class="form-control" name='city' id='city' value='{{ old('city', $location->city) }}'>
                        <br>

                        <label for='state' class="control-label">State</label>
                        <input type='text' class="form-control" name='state' id='state' value='{{ old('state', $location->state) }}'>
                        <br>

                        <label for='country' class="control-label">* Country</label>
                        <input type='text' class="form-control" name='country' id='country' value='{{ old('country', $location->country) }}'>
                        <br>

                        <label for='location_image' class="control-label">Image (URL)</label>
                        <input type='url' class="form-control" name='location_image' id='location_image' value='{{ old('location_image', $location->location_image) }}'>
                        <br>

                        <label for='location_notes' class='control-label'>Notes</label>
                        <input type='text' class='form-control' name='location_notes' id='location_notes' value='{{ old('location_notes', $location->location_notes) }}'>
                        <br>

                    </div><!--close form group-->

                    @include('errors')

                    <br><input class='btn btn-primary' type='submit' value='Save changes'>&nbsp; &nbsp; &nbsp; &nbsp;
                    <a href='/locations/showall' class='btn btn-info' role='button'>Return to All Locations</a>

                </form><!--close form-->

            </div>
        </div><!--close bootstrap row-->
    </div><!--close div form-->

@endsection
