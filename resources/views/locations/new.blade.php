@extends('layouts.master')

@section('title')
    New Location
@endsection

@push('head')
    <link href='/css/a4.css' rel='stylesheet'>
@endpush

@section('content')
    <h1>Add a New Location!</h1>
    <hr>

    <form method='POST' action='/locations/new'>
        {{ csrf_field() }}

        <small>* Required fields</small>

        <label for='city'>* City</label>
        <input type='text' name='city' id='title' value='{{ old('city', 'Cambridge') }}'>

        <label for='state'> State</label>
        <input type='text' name='state' id='state' value='{{ old('state', 'Massachusetts') }}'>

        <label for='country'> Country</label>
        <input type='text' name='country' id='country' value='{{ old('country', 'United States') }}'>

        <label for='location_image'> Image</label>
        <input type='text' name='location_image' id='location_image' value='{{ old('location_image', 'http://www.barnesandnoble.com/w/green-eggs-and-ham-dr-seuss/1100170349') }}'>

        <input class='btn btn-primary' type='submit' value='Add new location'>
    </form>


@endsection
