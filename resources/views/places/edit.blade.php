@extends('layouts.master')

@section('title')
    Edit place: {{ $place->place_name}}
@endsection

@push('head')
    <link href='/css/a4.css' rel='stylesheet'>
@endpush

@section('content')
    <h1>Edit</h1>
    <h2>{{ $place->place_name}}</h2>

    <form method='POST' action='/places/edit'>
        {{ csrf_field() }}

        <p>* Required fields</p>

        <input type='hidden' name='id' value='{{$place->id}}'>

        <label for='place_name'>* Place Name</label>
        <input type='text' name='place_name' id='place_name' value='{{ old('place_name', $place->place_name) }}'>

        <label for='place_image'> URL to an image</label>
        <input type='text' name='place_image' id='place_image' value='{{ old('place_image', $place->place_image) }}'>

        <label for='place_link'>* Purchase link</label>
        <input type='text' name='place_link' id='place_link' value='{{ old('place_link', $place->place_link) }}'>

        <label for='location_id'>* Location:</label>
        <select id='location_id' name='location_id'>
            <option value='0'>Choose</option>
            @foreach($locationsForDropdown as $location_id => $locationCity)
                <option value='{{ $location_id }}' {{ ($place->location_id == $location_id) ? 'SELECTED' : '' }}>
                    {{ $locationCity }}
                </option>
            @endforeach
        </select>

        <label>Tags</label>


        <br><input class='btn btn-primary' type='submit' value='Save changes'><br><br>

    </form>



@endsection
