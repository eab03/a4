@extends('layouts.master')

@section('title')
    New Location
@endsection

@push('head')
    <link href='/css/a4.css' rel='stylesheet'>
@endpush

@section('content')
    <h1>Add a New Place!</h1>
    <hr>

    <form method='POST' action='/places/new'>
        {{ csrf_field() }}

        <div class="form-group text-entry">
            <small>* Required fields</small>
            <br>

            <label for='name' class='control-label'>* Place Name</label>
            <input type='text' class="form-control" name='name' id='name' placeholder='Cafe Crema' value='{{ old('name', '') }}'>
            <br>

            <label for='place_link' class='control-label'>Web Link</label>
            <input type='text' class="form-control" name='place_link' id='place_link' value='{{ old('place_link', 'https://www.cremacambridge.com/') }}'>
            <br>

            <label for='place_image' class='control-label'>Image</label>
            <input type='text' class="form-control" class='imgOne' name='image_link' id='image_link' placeholder='http://www.cambridgelocalfirst.org/wp-content/uploads/2014/09/748_Crema_4.jpg', value='{{ old('image_link', '') }}'>
            <br>
        </div>

        <div class="form-group dropdown">
            <label for='location_id' class="control-label">* Location</label>
            <select class="form-control" id='location_id' name='location_id'>
            <option value='0'>Choose</option>
                @foreach($locationsForDropdown as $location_id => $locationCity)
                    <option value='{{ $location_id }}'>
                        {{ $locationCity }}
                    </option>
                @endforeach
            </select>
            <br>
        </div>

        <fieldset class="form-check checkbox">
            <legend>Tags</legend><br>
                @foreach($tagsForCheckboxes as $id => $name)
                    <label for='tag_{{ $id }}'>
                    <input
                    type='checkbox'
                    class="form-check-input"
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
