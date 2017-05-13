@extends('layouts.master')

@section('title')
    Create a New Place
@endsection

@section('content')

<div class='container'>

    <div class='row top'>
        <div class='col-sm-12 col-md-12 col-lg-12'>
            <h1>Add a New Place!</h1>
        </div>
    </div>
    <hr>

    <form method='POST' action='/places/new'>
        {{ csrf_field() }}

        <small>* Required fields</small>
        <br>

        <div class='text-entry'>
            <label for='name' class='control-label'>* Place Name</label>
            <input type='text' class='form-control' name='name' id='name' placeholder='Cafe Crema' value='{{ old('name', '') }}'>
            <br>
        </div>

        <div class='form-group dropdown'>
            <label for='location_id' class='control-label'>* Location</label>
            <select class='form-control' id='location_id' name='location_id'>
            <option value='0'>Choose</option>
                @foreach($locationsForDropdown as $location_id => $location)
                    <option value='{{ $location_id }}'>
                        {{ $location }}
                    </option>
                @endforeach
            </select>
            <br>
        </div>

        <div class='text-entry'>
            <label for='place_notes' class='control-label'>Notes</label>
            <textarea name='place_notes' rows=2 class='form-control' id='place_notes' placeholder='Type Notes Here'>{{ old('place_notes', '') }}</textarea>
        </div>

        <div class='text-entry'>
            <label for='place_link' class='control-label'>Website</label>
            <input type='text' class='form-control' name='place_link' id='place_link' placeholder='https://www.cremacambridge.com/' value= '{{ old('place_link', '') }}'>
            <br>

            <label for='place_image' class='control-label'>Image</label>
            <input type='text' class='form-control' class='imgOne' name='place_image' id='place_image' placeholder='http://www.cambridgelocalfirst.org/wp-content/uploads/2014/09/748_Crema_4.jpg', value='{{ old('place_image', '') }}'>
            <br>
        </div>

        <fieldset class='form-check checkbox'>
            <legend>Tags</legend>
                @foreach($tagsForCheckboxes as $id => $name)
                    <label for='tag_{{ $id }}' class='control-label'>
                    <input
                    type='checkbox'
                    class='form-check-input'
                    value='{{ $id }}'
                    id='tag_{{ $id }}'
                    name='tags[]'>
                    {{ $name }}&nbsp;&nbsp;&nbsp;&nbsp;
                    </label>
                @endforeach
        </fieldset>

        @include('errors')

        <input class='btn btn-primary' type='submit' value='Add new place'>
    </form>

@endsection
