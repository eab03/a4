@extends('layouts.master')

@section('title')
    New Location
@endsection

@section('content')
    <div class="top">
        <h1>Add a New Location!</h1>
        <hr>
    </div>

    <form method='POST' action='/locations/new'>
        {{ csrf_field() }}

        <div class="form-group text-entry">
            <small>* Required fields</small>
            <br>

            <label for='city' class="control-label">* City</label>
            <input type='text' class="form-control" name='city' id='title' value='{{ old('city', 'Cambridge') }}'>

            <label for='state' class="control-label"> State</label>
            <input type='text' class="form-control" name='state' id='state' value='{{ old('state', 'Massachusetts') }}'>

            <label for='country' class="control-label"> Country</label>
            <input type='text' class="form-control" name='country' id='country' value='{{ old('country', 'United States') }}'>

            <label for='location_image' class="control-label"> Image</label>
            <input type='text' class="form-control" name='location_image' id='location_image' value='{{ old('location_image', 'http://www.barnesandnoble.com/w/green-eggs-and-ham-dr-seuss/1100170349') }}'>
        </div>
            <input class='btn btn-primary' type='submit' value='Add new location'>

    </form>


@endsection
