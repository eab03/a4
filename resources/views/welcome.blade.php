@extends('layouts.master')

@section('title')
    Things to Do, Places to Go!
@endsection

@section('content')

    <section class='intro'>
        <div class='row'>
            <div class='col-sm-12 col-md-12 col-lg-12'>
                <h1>FavePlaces</h1>
                <br>
                <img src="http://images.clipartpanda.com/travel-clipart-travelbook.jpg" alt="Fun image">
                <br>
                <h3>A fun and easy way to record, collect and share<br>information about your favorite places!</h3>
                <br>
                <a href='/places'>Let the Adventures Begin!</a>
                <br><br><br>
            </div>
        </div><!--close bootstrap row-->
        
    </section><!-- close div container-->

@endsection
