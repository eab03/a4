<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Place;
use App\Location;
use App\Tag;
use Session;

class PlaceController extends Controller
{
    /**
    * GET
    * /places/
    */
    public function index(Request $request) {

        $locations=[];
        $newPlaces=[];

        $locations = Location::orderBy('created_at', 'descending')->get(); # Query DB
        $threeLocations = $locations->sortBy('created_at')->take(3); # Query existing Collection

        $newPlaces = Place::orderBy('created_at', 'descending')->limit(3)->get(); # Query DB

        return view('places.index')->with([
            'locations' => $threeLocations,
            'newPlaces' => $newPlaces,
        ]);
    }

    /**
    * GET
    * /places/show
    */
    public function showPlace(Request $request)  {
        $places=[];

        $locations = Location::orderBy('created_at', 'descending')->get(); # Query DB

        $places = Place::orderBy('created_at', 'descending')->get(); # Query DB

        return view('places.show')->with([
            'locations' => $locations,
            'places' => $places,
        ]);
    }

    /**
    * GET
    * /locations/search
    */
    public function searchPlace(Request $request) {
        return view('places.search');
    }

    /**
    * GET
    * /places/new
    * Display the form to add a new place
    */
    public function createNewPlace(Request $request) {
        return view('places.new');
    }

    /**
    * POST
    * /places/new
    * Display the form to add a new place
    */
    public function storeNewPlace(Request $request) {
        return view('places.new');
    }

    /**
    * GET
    * /places/edit
    * Display the form to add a new place
    */
    public function editPlace(Request $request) {
        return view('places.edit');
    }

    /**
    * POST
    * /places/edit
    * Display the form to add a new place
    */
    public function saveEditsPlace(Request $request) {
        return view('places.edit');
    }

    /**
    * GET
    * /places/delete
    */
    public function confirmDeletionPlace(Request $request)  {
        return view('places.delete');
    }

    /**
    * POST
    * /places/delete
    */
    public function deletePlace(Request $request)  {
        return view('places.delete');
    }

    /**
    * GET
    * /locations/search
    */
    public function showLocation(Request $request) {
        $locations=[];

        $locations = Location::orderBy('city', 'asc')->get(); # Query DB

        return view('locations.show')->with([
            'locations' => $locations,
        ]);
    }

    /**
    * GET
    * /locations/search
    */
    public function searchLocation(Request $request) {
        return view('locations.search');
    }

    /**
    * GET
    * /locations/new
    * Display the form to add a new location
    */
    public function createNewLocation(Request $request) {
        return view('locations.new');
    }

    /**
    * POST
    * /locations/new
    * Display the form to add a new location
    */
    public function storeNewLocation(Request $request) {
        return view('locations.new');
    }

    /**
    * GET
    * /locations/edit
    * Display the form to add a new place
    */
    public function editLocation(Request $request) {
        return view('locations.edit');
    }

    /**
    * POST
    * /locations/edit
    * Display the form to add a new place
    */
    public function saveEditsLocation(Request $request) {
        return view('locations.edit');
    }

    /**
    * GET
    * /places/delete
    */
    public function confirmDeletionLocation(Request $request)  {
        return view('locations.delete');
    }

    /**
    * POST
    * /places/delete
    */
    public function deleteLocation(Request $request)  {
        return view('locations.delete');
    }

}
