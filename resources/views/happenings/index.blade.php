@extends('layouts.master')

@push('head')
    <link href='/css/a4.css' rel='stylesheet'>
@endpush

@section('title')
    Calendar
@endsection

@section('content')

    <nav>
        <ul>
            <li><a href='/'>Home</a></li>
            <li><a href='/search'>Search</a></li>
            <li><a href='/new'>Add an Event</a></li>
        </ul>
    </nav>

@endsection
