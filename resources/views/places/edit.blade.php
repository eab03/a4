@extends('layouts.master')

@section('title')
    Edit Place: {{ $place->name}}
@endsection

@push('head')
    <link href='/css/a4.css' rel='stylesheet'>
@endpush

@section('content')
    <div class="top">
        <h1>Edit: <em>{{ $place->name}}</em></h1>
        <hr>
    </div>

    <form method='POST' name="editForm" action='/places/edit'>
        {{ csrf_field() }}

        <small>* Required fields</small>
        <br>

        <input type='hidden' name='id' value='{{$place->id}}'>

        <div class="text-entry">
            <label for='name' class='control-label'>* Place Name</label>
            <input type='text' class="form-control" name='name' id='name' value='{{ old('name', $place->name) }}'>
            <br>
        </div>

        <div class="form-group dropdown">
            <label for='location_id' class="control-label">* Location</label>
            <select class="form-control" id='location_id' name='location_id'>
                <option value='0'>Choose</option>
                @foreach($locationsForDropdown as $location_id => $location)
                    <option value='{{ $location_id }}' {{ ($place->location_id == $location_id) ? 'SELECTED' : '' }}>
                        {{ $location }}
                    </option>
                @endforeach
            </select>
            <br>
        </div>

        <div class="text-entry">
            <label for='place_notes' class='control-label'>Notes</label>
            <textarea class="form-control" name='place_notes' id='place_notes'rows=2 form="editForm" value='{{ old('place_notes', $place->place_notes) }}'></textarea>
        </div>

        <div class="text-entry">
            <label for='place_link' class='control-label'>Website</label>
            <input type='text' class="form-control" name='place_link' id='place_link' value='{{ old('place_link', $place->place_link) }}'>
            <br>

            <label for='place_image' class='control-label'>Image</label>
            <input type='text' class="form-control" class='imgOne' name='place_image' id='place_image' value='{{ old('place_image', $place->place_image) }}'>
            <br>
        </div>

        <fieldset class="form-check checkbox">
            <legend>Tags</legend>
                <div class="tags">
                     @foreach($tagsForCheckboxes as $id => $name)
                         <label for='tag_{{ $id }}' class="control-label" >
                             <input
                             type='checkbox'
                             class="form-check-input"
                             value='{{ $id }}'
                             id='tag_{{ $id }}'
                             name='tags[]'
                             {{ (in_array($name, $tagsForThisPlace)) ? 'CHECKED' : '' }}>
                             {{ $name }}&nbsp;&nbsp;&nbsp;&nbsp;
                         </label>
                     @endforeach
                </div
        </fieldset>

        @include('errors')

        <br><input class='btn btn-primary' type='submit' value='Save changes'><br><br>

    </form>



@endsection
