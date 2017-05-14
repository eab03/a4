@extends('layouts.master')

@section('title')
    Confirm deletion: {{ $location->city }}
@endsection

@section('content')

    <section class='top'><!--new section-->
        <div class='row'><!--new bootstrap row-->
            <div class='col-sm-12 col-md-12 col-lg-12'>
                <h1>Confirm Deletion</h1>
            </div>
        </div><!--close bootstrap row-->
        <hr>
    </section><!--close section-->

    <!--form for deleting a single location-->
    <div class='form'><!--new section-->
        <div class='row'><!--new bootstrap row-->
            <div class='col-sm-12 col-md-12 col-lg-12'>

                <form method='POST' action='/locations/delete'>
                    {{ csrf_field() }}

                    <input type='hidden' name='id' value='{{ $location->id }}'>

                    @if( $location->state !=null)
                        <h2>Are you sure you want to delete:<br><em>{{ $location->city }}, {{ $location->state }}, {{ $location->country}}</em>?</h2>
                    @else
                        <h2>Are you sure you want to delete:<br><em>{{ $location->city }}, {{ $location->country}}</em>?</h2>
                    @endif

                    <br><br>
                    <input type='submit' value='Yes, delete this city.' class='btn btn-danger'>&nbsp; &nbsp; &nbsp; &nbsp;
                    <a href='/locations/show/{{ $locations->id }}' class='btn btn-info' role='button'>No. Return to '{{ $location->city }}'.</a>

                </form><!-- close form-->

            </div>
        </div><!-- close bootstrap row-->
    </div><!--close section form-->

@endsection
