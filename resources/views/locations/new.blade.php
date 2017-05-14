@extends('layouts.master')

@section('title')
    New Location
@endsection

@section('content')

    <section class='top'>
        <div class='row'>
            <div class='col-sm-12 col-md-12 col-lg-12'>
                <h1>Add a New Location</h1>
            </div>
        </div>
        <hr>
    </section>

    <!--form for adding a new location-->
    <div class='row'>
        <div class='col-sm-12 col-md-12 col-lg-12'>

            <form method='POST' action='/locations/new'>
                {{ csrf_field() }}

                <div class='form-group text-entry'>

                    <small>* Required fields</small>
                    <br><br>

                    <label for='city' class='control-label'>* City</label>
                    <input type='text' class='form-control' name='city' id='title' placeholder='Cambridge' value='{{ old('city', '') }}'>
                    <br>
                    <label for='state' class='control-label'> State</label>
                    <input type='text' class='form-control' name='state' id='state' placeholder='MA' value='{{ old('state', '') }}'>
                    <br>
                    <label for='country' class='control-label'>* Country</label>
                    <input type='text' class='form-control' name='country' id='country' placeholder='USA' value='{{ old('country', '') }}'>
                    <br>
                    <label for='location_image' class='control-label'> Image (URL)</label>
                    <input type='text' class='form-control' name='location_image' id='location_image' placeholder='http://www.cambridgelocalfirst.org/wp-content/uploads/2014/09/748_Crema_4.jpg' value='{{ old('location_image', '') }}'>
                    <br>
                </div><!-- close form group-->

                    @include('errors')

                    <br>
                    <input class='btn btn-primary' type='submit' value='Add new location'>

            </form><!--close form-->

        </div>
    </div><!--close bootstrap row-->

@endsection
