@extends('layouts.master')

@section('title')
    New Location
@endsection

@push('head')
    <link href='/css/a4.css' rel='stylesheet'>
@endpush


@section('content')
    <h1>Add a New Place!</h1>

    <form method='POST' action='/places/new'>
        {{ csrf_field() }}

        <small>* Required fields</small>
        <br>

        <label for='name'>* Place Name</label>
        <input type='text' name='name' id='name' value='{{ old('name', 'Cafe Crema') }}'>
        <br>

        <label for='place_link'>Web Link</label>
        <input type='text' name='place_link' id='place_link' value='{{ old('place_link', 'https://www.cremacambridge.com/') }}'>
        <br>

        <label for='place_image'>Image</label>
        <input type='text' class='imgOne' name='image_link' id='image_link' value='{{ old('image_link', 'http://www.cambridgelocalfirst.org/wp-content/uploads/2014/09/748_Crema_4.jpg') }}'>
        <br>

        <label for='location_id'>* Location:</label>
        <select id='location_id' name='location_id'>
            <option value='0'>Choose</option>
            @foreach($locationsForDropdown as $location_id => $locationCity)
                <option value='{{ $location_id }}'>
                    {{ $locationCity }}
                </option>
            @endforeach
        </select>
        <br>

        <label>Tags</label>
            <ul id='tags'>
                @foreach($tagsForCheckboxes as $id => $name)
                    <li>
                        <input type='checkbox' value='{{ $id }}' id='tag_{{ $id }}' name='tags[]'
                    <label for='tag_{{ $id }}'>{{ $name }}</label></li>
                @endforeach
            </ul>


        @include('errors')

        <input class='btn btn-primary' type='submit' value='Add new place'>
    </form>

@endsection
