@extends('layouts.master')

@section('title')
    Things to Do, Places to Go!
@endsection

@section('content')

    <div class='container intro'>

        <div class='col-sm-12 col-md-12 col-lg-12'>
            <h1>Let the Adventures Begin!</h1>
            <br>
        </div>
        <div class='col-sm-12 col-md-12 col-lg-12'>
            <img src="http://images.clipartpanda.com/travel-clipart-travelbook.jpg"alt="Fun image">
            <br>
        </div>
        <div class='col-sm-12 col-md-12 col-lg-12'>
            <h2>A fun and easy way to record, collect and share<br>information about your favorite places!</h2>
            <br>
            <a href='/places'>Click Here to Begin!</a>
        </div>

    </div><!-- close div container-->

@endsection
