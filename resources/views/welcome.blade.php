@extends('layouts.master')

@push('head')
    <link href='/css/a4welcome.css' rel='stylesheet'>
@endpush

@section('title')
    Things to Do, Places to Go!
@endsection

@section('content')
    <div class="intro">
        <h1>Let the Adventures Begin!</h1>
        <br>
        <img src="http://images.clipartpanda.com/travel-clipart-travelbook.jpg"alt="Fun image">
        <br>
        <h2>A fun and easy way to record, collect and share<br>information about your favorite places!</h2>
        <br>
        <a href='/places'>Click Here to Begin!</a>
    </div>
@endsection
