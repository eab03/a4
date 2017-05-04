@extends('layouts.master')

@section('title')
    New Location
@endsection

@push('head')
    <link href='/css/books.css' rel='stylesheet'>
@endpush


@section('content')
    <h1>Add a New Location!</h1>

    <form method='POST' action='/locations/new'>
        {{ csrf_field() }}

        <small>* Required fields</small>

        <label for='city'>* City</label>
        <input type='text' name='city' id='title' value='{{ old('city', 'Cambridge') }}'>

        <label for='state'> State</label>
        <input type='text' name='state' id='state' value='{{ old('state', 'Massachusetts') }}'>

        <label for='country'> Country</label>
        <input type='text' name='country' id='country' value='{{ old('country', 'United States') }}'>

        <label for='image_link'> Location Image</label>
        <input type='text' name='image_link' id='image_link' value='{{ old('image_link', 'http://www.barnesandnoble.com/w/green-eggs-and-ham-dr-seuss/1100170349') }}'>

        <label for='location_id'>* Location:</label>
        <select id='location_id' name='location_id'>
            <option value='0'>Choose</option>
            @foreach($locationsForDropdown as $location_id => $locationCity)
                <option value='{{ $location_id }}'>
                    {{ $locationCity }}
                </option>
            @endforeach
        </select>

        @include('errors')

        <input class='btn btn-primary' type='submit' value='Add new book'>
    </form>


@endsection
