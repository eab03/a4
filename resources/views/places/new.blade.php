@extends('layouts.master')

@section('title')
    New Location
@endsection

@push('head')
    <link href='/css/a4.css' rel='stylesheet'>
@endpush


@section('content')
    <h1>Add a New Location!</h1>

    <form method='POST' action='/places/new'>
        {{ csrf_field() }}

        <small>* Required fields</small>

        <label for='place_name'>* Place Name</label>
        <input type='text' name='place_name' id='place_name' value='{{ old('place_name', 'Cafe Crema') }}'>

        <label for='place_link'>Web Link</label>
        <input type='text' name='place_link' id='place_link' value='{{ old('place_link', 'https://www.cremacambridge.com/') }}'>

        <label for='place_image'>Image</label>
        <input type='text' class='imgOne' name='image_link' id='image_link' value='{{ old('image_link', 'http://www.cambridgelocalfirst.org/wp-content/uploads/2014/09/748_Crema_4.jpg') }}'>

        <label for='location_id'>* Location:</label>
        <select id='location_id' name='location_id'>
            <option value='0'>Choose</option>
            @foreach($locationsForDropdown as $location_id => $locationCity)
                <option value='{{ $location_id }}'>
                    {{ $locationCity }}
                </option>
            @endforeach
        </select>






        <input class='btn btn-primary' type='submit' value='Add new place'>
    </form>

@endsection
