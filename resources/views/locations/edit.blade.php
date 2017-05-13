@extends('layouts.master')

@section('title')
    Edit Locations
@endsection

@section('content')
    <div class="top">
        @if( $location->state !=null)
            <h1>{{ $location->city }}, {{ $location->state }}, {{ $location->country}}</h1>
        @else
            <h1>{{ $location->city }}, {{ $location->country}}</h1>
        @endif
        <hr>
    </div>

    <form method='POST' action='/locations/edit'>

        {{ csrf_field() }}

        <div class="form-group text-entry">
            <small>* Required fields</small>
            <br>

            <input type='hidden' name='id' value='{{$location->id}}'>

            <label for='city' class="control-label">* City</label>
            <input type='text' class="form-control" name='city' id='city' value='{{ old('city', $location->city) }}'>
            <br>

            <label for='state' class="control-label">State</label>
            <input type='text' class="form-control" name='state' id='state' value='{{ old('state', $location->state) }}'>
            <br>

            <label for='country' class="control-label">Country</label>
            <input type='text' class="form-control" name='country' id='country' value='{{ old('country', $location->country) }}'>
            <br>

            <label for='location_image'class="control-label">URL to an image</label>
            <input type='text' class="form-control" name='location_image' id='location_image' value='{{ old('location_image', $location->location_image) }}'>
            <br>

        </div>

        <br><input class='btn btn-primary' type='submit' value='Save changes'><br><br>

    </form>



@endsection
