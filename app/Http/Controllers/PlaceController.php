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

        $locations = Location::orderBy('updated_at', 'descending')->limit(3)->get(); # Query DB

        $places = Place::orderBy('place_name', 'descending')->get(); # Query DB

        $newPlaces = $places->sortByDesc('updated_at')->take(3); # Query existing Collection

        return view('places.index')->with([
            'locations' => $locations,
            'newPlaces' => $newPlaces,
        ]);
    }

    /**
    * GET
    * /books/{id}
    */
    public function showPlace($id) {

        $place = Place::find($id);

        if(!$place) {
            Session::flash('message', 'The place you are looking for could not be found.');
            return redirect('/places');
        }
        return view('places.show')->with([
            'place' => $place,
        ]);
    }

    /**
    * GET
    * /places/show
    */
    public function showallPlace(Request $request) {

        $places = Place::orderBy('place_name', 'asc')->get(); # Query DB

        return view('places.showall')->with([
            'places' => $places,
        ]);
    }

    /**
    * GET
    * /places/search
    */
    public function searchPlace(Request $request) {

        $locations = [];
        $locations = Location::orderBy('city', 'asc')->get(); # Query DB

        # Start with an empty array of search results; places that
        # match our search query will get added to this array
        $searchResults = [];
        # Store the searchTerm in a variable for easy access
        # The second parameter (null) is what the variable
        # will be set to *if* searchTerm is not in the request.
        $searchPlace = $request->input('searchPlace', null);
        # Only try and search *if* there's a searchTerm
        if($searchPlace) {
            # Open the places.json data file
            # database_path() is a Laravel helper to get the path to the database folder
            # See https://laravel.com/docs/5.4/helpers for other path related helpers
            $placesRawData = file_get_contents(database_path().'/places.json');
            # Decode the place JSON data into an array
            # Nothing fancy here; just a built in PHP method
            $places = json_decode($placesRawData, true);
            # Loop through all the place data, looking for matches


            foreach($places as $name => $place) {

                # Case sensitive boolean check for a match
                if($request->has('caseSensitive')) {
                    $match = $name == $searchPlace;
                }
                # Case insensitive boolean check for a match
                else {
                    $match = strtolower($name) == strtolower($searchPlace);
                }

                # If it was a match, add it to our results
                if($match) {
                    $searchResults[$name] = $place;
                }
            }
        }
        # Return the view, with the searchTerm *and* searchResults (if any)
        return view('places.search')->with([
            'searchPlace' => $searchPlace,
            'caseSensitive' => $request->has('caseSensitive'),
            'searchResults' => $searchResults,
            'locations' => $locations
        ]);
    }

    /**
    * GET
    * /places/new
    * Display the form to add a new place
    */
    public function createNewPlace(Request $request) {

        $locationsForDropdown = Location::getLocationsForDropdown();

        return view('places.new')->with([
            'locationsForDropdown' => $locationsForDropdown,
        ]);
    }

    /**
    * POST
    * /places/new
    * Display the form to add a new place
    */

        public function storeNewPlace(Request $request) {

            # Custom error message
            $messages = [
                'location_id.not_in' => 'Location not selected.',
            ];

            $this->validate($request, [
                'place_name' => 'required|min:1',
                'place_image' => 'url',
                'place_link' => 'url',
                'location_id' => 'not_in:0',
            ], $messages);

            # Add new book to database
            $place = new Place();
            $place->place_name = $request->place_name;
            $place->place_link = $request->place_link;
            $place->place_image = $request->place_image;
            $place->location_id = $request->location_id;
            $place->save();

            # Now handle tags.
            # Note how the book has to be created (save) first *before* tags can
            # be added; this is because the tags need a book_id to associate with
            # and we don't have a book_id until the book is created.

            Session::flash('message', 'The place '.$request->place_name.' was added.');

            # Redirect the user to book index
            return redirect('/places');
        }

    /**
    * GET
    * /places/edit/{id}
    * Display the form to add a new place
    */
    public function editPlace($id) {

        $place = Place::find($id);

        if(is_null($place)) {
            Session::flash('message', 'The place you are looking for was not found.');
            return redirect('/places');
        }

        $locationsForDropdown = Location::getLocationsForDropdown();

        # Results in an array like this: $tagsForThisBook => ['novel','fiction','classic'];
        return view('places.edit')->with([
            'id' => $id,
            'place' => $place,
            'locationsForDropdown' => $locationsForDropdown,
        ]);
    }

    /**
    * POST
    * /places/edit
    * Display the form to add a new place
    */
    public function saveEditsPlace(Request $request) {
        # Custom error message
        $messages = [
            'location_id.not_in' => 'Location not selected.',
        ];

        $this->validate($request, [
            'place_name' => 'required|min:1',
            'place_image' => 'url',
            'place_link' => 'url',
            'location_id' => 'not_in:0',
        ], $messages);

        $place = Place::find($request->id);

        # Edit place in the database
        $place->place_name = $request->place_name;
        $place->place_image = $request->place_image;
        $place->place_link = $request->place_link;
        $place->location_id = $request->location_id;

        $place->save();
        Session::flash('message', 'Your changes to '.$place->place_name.' were saved.');
        return redirect('/places/edit/'.$request->id);
    }

    /**
    * GET
    * /places/delete
    */
    public function confirmDeletionPlace($id)  {
        # Get the book they're attempting to delete
        $place = Place::find($id);
        if(!$place) {
            Session::flash('message', 'Place not found.');
            return redirect('/places');
        }

        return view('places.delete')->with('place', $place);
    }

    /**
    * POST
    * /places/delete
    */
    public function deletePlace(Request $request)  {
    # Get the book to be deleted
    $place = Place::find($request->id);
    if(!$place) {
        Session::flash('message', 'Deletion failed; place not found.');
        return redirect('/places');
    }
    $place->delete();
    # Finish
    Session::flash('message', $place->place_name.' was deleted.');
    return redirect('/places');
}


    /**
    * GET
    * /locations/search
    */
    public function showallLocation(Request $request) {

        $locations = Location::orderBy('city', 'asc')->get(); # Query DB

        return view('locations.showall')->with([
            'locations' => $locations,
        ]);
    }

    /**
    * GET
    * /locations/{id}
    */
    public function showLocation($id) {

        $location = Location::find($id);

        if(!$location) {
            Session::flash('message', 'The location you are looking for could not be found.');
            return redirect('/locations/show');
        }
        return view('locations.show')->with([
            'location' => $location,
        ]);
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

        # Custom error message
        $messages = [
            'all wrong!'
        ];

        $this->validate($request, [
            'city' => 'required|min:1',
            'state' => 'min:2',
            'country' => 'min:2',
            'location_image' => 'url',
        ], $messages);

        # Add new book to database
        $location = new Location();
        $location->city = $request->city;
        $location->state = $request->state;
        $location->country = $request->country;
        $location->location_image = $request->location_image;
        $location->save();

        # Now handle tags.
        # Note how the book has to be created (save) first *before* tags can
        # be added; this is because the tags need a book_id to associate with
        # and we don't have a book_id until the book is created.

        Session::flash('message', 'The place '.$request->city.' was added.');

        # Redirect the user to book index
        return redirect('/places');
    }

    /**
    * GET
    * /locations/edit
    * Display the form to add a new place
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
    }

    /**
    * POST
    * /locations/edit
    * Display the form to add a new place
    */
    public function saveEditsLocation(Request $request) {
        # Custom error message
        $messages = [
            'all wrong!',
        ];

        $this->validate($request, [
            'city' => 'required|min:1',
            'state' => 'min:2',
            'country' => 'min:2',
            'location_image' => 'url',
        ], $messages);

        $location = Location::find($request->id);

        # Edit place in the database
        $location->city = $request->city;
        $location->state = $request->state;
        $location->country = $request->country;
        $location->location_image = $request->location_image;
        $location->save();

        Session::flash('message', 'Your changes to '.$location->city.' were saved.');
        return redirect('/places'.$request->id);
    }

    /**
    * GET
    * /places/delete
    */
    public function confirmDeletionLocation($id)  {
        # Get the book they're attempting to delete
        $location = Location::find($id);
        if(!$location) {
            Session::flash('message', 'Location not found.');
            return redirect('/locations/showall');
        }
        return view('locations.delete')->with('location', $location);
    }

    /**
    * POST
    * /places/delete
    */
    public function deleteLocation(Request $request)  {
    # Get the book to be deleted
        $location = Location::find($location->id);
        if(!$location) {
            Session::flash('message', 'Deletion failed; place not found.');
            return redirect('/locations/showall');
        }

        $location->delete();
        # Finish

        Session::flash('message', $location->city.' was deleted.');
        return redirect('/locations/showall');
    }

}
