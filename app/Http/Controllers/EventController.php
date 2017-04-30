<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
    * GET
    * / happenings
    */
    public function index(Request $request) {
        return view('happenings.index');

    }
}
