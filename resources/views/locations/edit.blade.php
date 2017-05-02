@extends('layouts.master')

@section('title')
    Edit Locations
@endsection

@push('head')
    <link href='/css/a4.css' rel='stylesheet'>
@endpush

@section('content')
    <h1>Edit Locations</h1>

    <form method='GET' action='/locations/edit'>

        <p>* Required fields</p>

        @foreach($locations as $location)

        <div class="locationEdits">
            <input type='hidden' name='id' value='{{$location->id}}'>

            <label for='city'>* City</label>
            <input type='text' name='city' id='city' value='{{ old('city', $location->city) }}'>

            <label for='state'>State</label>
            <input type='text' name='state' id='state' value='{{ old('state', $location->state) }}'>

            <label for='country'>Country</label>
            <input type='text' name='country' id='country' value='{{ old('country', $location->country) }}'>

            <label for='location_image'>URL to an image</label>
            <input type='text' name='location_image' id='location_image' value='{{ old('location_image', $location->location_image) }}'>
        </div>

        @endforeach

        <br><input class='btn btn-primary' type='submit' value='Save changes'><br><br>

    </form>



@endsection
