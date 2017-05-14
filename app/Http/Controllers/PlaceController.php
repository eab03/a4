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
    * Home page that lists 3 recent places and locations
    */
    public function index(Request $request) {

        $locations = Location::orderBy('updated_at', 'descending')->limit(3)->get();

        $places = Place::orderBy('name', 'descending')->get();

        $newPlaces = $places->sortByDesc('updated_at')->take(3);

        return view('places.index')->with([
            'locations' => $locations,
            'newPlaces' => $newPlaces,
        ]);
    } # close function

    /**
    * GET
    * /places/show/{id}
    * Show informaiton for one place
    */
    public function showPlace($id) {

        $place = Place::find($id);

        if(!$place) {
            Session::flash('message', 'The place you are looking for could not be found.');
            return redirect('/places/showall');
        } else {

            // Array of associated tag names, which will be shown in the view
            $tagsForThisPlace = [];
            foreach($place->tags as $tag) {
                $tagsForThisPlace[] = $tag->name;
            }
        } # end if/else statements

        return view('places.show')->with([
            'place' => $place,
            'tagsForThisPlace' => $tagsForThisPlace
        ]);
    } # close function

    /**
    * GET
    * /places/showall
    * Show list of all places
    */
    public function showallPlace(Request $request) {

        $places = Place::orderBy('name', 'asc')->get();

        return view('places.showall')->with([
            'places' => $places,
        ]);
    } # close function

    /**
    * GET
    * /places/search
    * Search query for one place
    */
    public function searchPlace(Request $request) {

        $locations= Location::orderBy('city', 'asc')->get();
        $places = Place::orderBy('name', 'asc')->get();

        // Array for search results
        $searchResults = [];

        $searchPlace = $request->input('searchPlace', null);

        // If search input matches list of places
        if($searchPlace) {

            // Get list of seed places from the json data
            $placesRawData = file_get_contents(database_path().'/places.json');
            $places = json_decode($placesRawData, true);

            // Loop through all the place data to look for a match
            foreach($places as $name => $place) {

                // Exact match if case sensitive is checked
                if($request->has('caseSensitive')) {
                    $match = $name == $searchPlace;
                }
                else {
                    $match = strtolower($name) == strtolower($searchPlace);
                }

                // If a match, add name to list of search results
                if($match) {
                    $searchResults[$name] = $place;
                }
            } # end foreach loop
        } # end if statement

        return view('places.search')->with([
            'caseSensitive' => $request->has('caseSensitive'),
            'locations' => $locations,
            'places' => $places,
            'searchPlace' => $searchPlace,
            'searchResults' => $searchResults,
        ]);
    } # close function

    /**
    * GET
    * /places/new
    * Display a form to add a new place
    */
    public function createNewPlace(Request $request) {

        $locationsForDropdown = Location::getLocationsForDropdown();

        $tagsForCheckboxes = Tag::getTagsForCheckboxes();

        return view('places.new')->with([
            'locationsForDropdown' => $locationsForDropdown,
            'tagsForCheckboxes' => $tagsForCheckboxes
        ]);
    } # close function

    /**
    * POST
    * /places/new
    * Display a form to add and save new place
    */
    public function storeNewPlace(Request $request) {

        // Custom error message
        $messages = [
            'location_id.not_in' => 'Location not selected.',
        ];

        $this->validate($request, [
            'name' => 'required|min:1',
            'place_image' => 'nullable|url|max:191',
            'place_link' => 'nullable|url',
            'place_notes' => 'nullable|max:1000',
            'location_id' => 'not_in:0',
        ], $messages);

        // Add new place to the database
        $place = new Place();
        $place->name = $request->name;
        $place->place_link = $request->place_link;
        $place->place_image = $request->place_image;
        $place->place_notes = $request->place_notes;
        $place->location_id = $request->location_id;
        $place->save();

        $tags = ($request->tags) ?: [];
        $place->tags()->sync($tags);
        $place->save();

        Session::flash('message', 'The place '.$request->name.' was added.');

        return redirect('/places');
    } # close function

    /**
    * GET
    * /places/edit/{id}
    * Display a form to edit place fields
    */
    public function editPlace($id) {

        $place = Place::with('tags')->find($id);

        if(is_null($place)) {
            Session::flash('message', 'The place you are looking for was not found.');
            return redirect('/places/showall');
        }

        $locationsForDropdown = Location::getLocationsForDropdown();

        $tagsForCheckboxes = Tag::getTagsForCheckboxes();

        // Array of associated tag names, which will be shown in the view
        $tagsForThisPlace = [];
        foreach($place->tags as $tag) {
            $tagsForThisPlace[] = $tag->name;
        }

        return view('places.edit')->with([
            'id' => $id,
            'locationsForDropdown' => $locationsForDropdown,
            'place' => $place,
            'tagsForCheckboxes' => $tagsForCheckboxes,
            'tagsForThisPlace' => $tagsForThisPlace,
        ]);
    } # close function

    /**
    * POST
    * /places/edit
    */
    public function saveEditsPlace(Request $request) {

        # Custom error message
        $messages = [
            'location_id.not_in' => 'Location not selected.',
        ];

        $this->validate($request, [
            'name' => 'required|min:1',
            'place_image' => 'nullable|url|max:191',
            'place_link' => 'nullable|url',
            'place_notes' => 'nullable|max:1000',
            'location_id' => 'not_in:0',
        ], $messages);

        $place = Place::find($request->id);

        // Edit place in the database
        $place->name = $request->name;
        $place->place_image = $request->place_image;
        $place->place_link = $request->place_link;
        $place->place_notes = $request->place_notes;
        $place->location_id = $request->location_id;

        // if there are tags, get the tags; if no tags revert to empty array
        $tags = ($request->tags) ?: [];

        // Sync tags
        $place->tags()->sync($tags);
        $place->save();

        Session::flash('message', 'Your changes to '.$place->name.' were saved.');
        return redirect('/places/edit/'.$request->id);
    } # close function

    /**
    * GET
    * /places/delete
    * Show page to delete a place
    */
    public function confirmDeletionPlace($id)  {

        $place = Place::find($id);

        if(!$place) {
            Session::flash('message', 'Place not found.');
            return redirect('/places/showall');
        }

        return view('places.delete')->with('place', $place);
    } # close function

    /**
    * POST
    * /places/delete
    */
    public function deletePlace(Request $request)  {

        $place = Place::find($request->id);

            if(!$place) {
                Session::flash('message', 'Deletion failed; place not found.');
                return redirect('/places');
            }

            $place->tags()->detach();

            $place->delete();

        Session::flash('message', $place->name.' was deleted.');
        return redirect('/places');
    } # close function

    //////////////////////////////////////////////////////////////

    /**
    * GET
    * /locations/showall
    * Show all locations
    */
    public function showallLocation(Request $request) {

        $locations = Location::orderBy('city', 'asc')->get(); # Query DB

        return view('locations.showall')->with([
            'locations' => $locations,
        ]);
    } # close function

    /**
    * GET
    * /locations/{id}
    * Show information for a single location
    */
    public function showLocation($id) {

        $locations = Location::orderBy('city', 'asc')->get();
        $location = Location::find($id);

        if(!$location) {
            Session::flash('message', 'The location you are looking for could not be found.');
            return redirect('/locations/showall');
        }
        return view('locations.show')->with([
            'location' => $location,
            'locations' => $locations,
        ]);
    } # close function

    /**
    * GET
    * /locations/new
    * Display a form to add a new location
    */
    public function createNewLocation(Request $request) {
        return view('locations.new');
    } # close function

    /**
    * POST
    * /locations/new
    */

    public function storeNewLocation(Request $request) {

        # Custom error message
        $messages = [];

        $this->validate($request, [
            'city' => 'required|min:1',
            'state' => 'nullable|min:2',
            'country' => 'required|min:2',
            'location_image' => 'nullable|url',
        ], $messages);

        // Add a new location to the database
        $location = new Location();
        $location->city = $request->city;
        $location->state = $request->state;
        $location->country = $request->country;
        $location->location_image = $request->location_image;
        $location->save();

        Session::flash('message', 'The place '.$request->city.' was added.');

        return redirect('/places');
    } # close function

    /**
    * GET
    * /locations/edit{id}
    * Display a form to edit location fields
    */
    public function editLocation($id) {

         $location = Location::find($id);

        if(is_null($location)) {
            Session::flash('message', 'The location you are looking for was not found.');
            return redirect('/locations/showall');
        }

        return view('locations.edit')->with([
            'id' => $id,
            'location' => $location,
        ]);
    } # close function

    /**
    * POST
    * /locations/edit
    */
    public function saveEditsLocation(Request $request) {

        // Custom error message
        $messages = [];

        $this->validate($request, [
            'city' => 'required|min:1',
            'state' => 'nullable|min:2',
            'country' => 'required|min:2',
            'location_image' => 'nullable|url',
        ], $messages);

        $location = Location::find($request->id);

        // Edit location in the database
        $location->city = $request->city;
        $location->state = $request->state;
        $location->country = $request->country;
        $location->location_image = $request->location_image;
        $location->save();

        Session::flash('message', 'Your changes to '.$location->city.' were saved.');
        return redirect('/places');
    } # close function

    /**
    * GET
    * /places/delete
    * Display page with option to delete location
    */
    public function confirmDeletionLocation($id)  {

        $location = Location::find($id);

        if(!$location) {
            Session::flash('message', 'Location not found.');
            return redirect('/places');
        }

        return view('locations.delete')->with('location', $location);
    } # function

    /**
    * POST
    * /places/delete
    */
    public function deleteLocation(Request $request)  {

        // Get the location to be deleted
        $locations = Location::find($request->id);

        $places = Place::orderBy('location_id', 'asc')->get(); # Query DB

            foreach($places as $name => $place) {
                foreach($locations as $city => $location) {
                    if($match = $request->id == $place->location_id) {
                        Session::flash('message', 'Deletion failed; delete any associated places first.');
                        return redirect('/locations/showall');
                    } # end if statement
                } # end foreach loop
            } #end foreach loop

        if(!$locations) {
            Session::flash('message', 'Deletion failed; place not found.');
            return redirect('/locations/showall');
        } #end if statement

        $locations->delete();

        Session::flash('message', $locations->city.' was deleted.');
        return redirect('/locations/showall');
    } # close function
} # close PlaceController
