@extends('layouts.master')

@section('title')
    Confirm deletion: {{ $place->place_name }}
@endsection

@section('content')

    <section class='top'><!--new section-->
        <div class='row'><!--new bootstrap row-->
            <div class='col-sm-12 col-md-12 col-lg-12'>
                <h1>Confirm deletion</h1>
            </div>
        </div><!--close bootstrap row-->
        <hr>
    </section><!--close section top-->

    <!--form for deleting indiividual place record-->
    <section class='places'><!--new section-->
        <div class='row'><!--new bootstrap row-->
            <div class='col-sm-12 col-md-12 col-lg-12'>

                <form method='POST' action='/places/delete'>
                    {{ csrf_field() }}

                    <input type='hidden' name='id' value='{{ $place->id }}'?>

                    <h2>Are you sure you want to delete:<br><em>{{ $place->name }}</em>?</h2>

                    <br><br>
                    <input type='submit' value='Yes, delete this place.' class='btn btn-danger'>&nbsp; &nbsp; &nbsp; &nbsp;
                    <a href='/places/show/{{ $place->id }}'><input type='button' value="No. Go back to '{{ $place->name }}'." class='btn btn-info'></a>

                    @include('errors')

                </form><!-- close form-->
            </div>
        </div><!-- close bootstrap row-->
    </section><!--close section places-->

@endsection
