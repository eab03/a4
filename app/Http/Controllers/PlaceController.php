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

        $locations = Location::orderBy('created_at', 'descending')->limit(3)->get(); # Query DB

        $places = Place::orderBy('created_at', 'descending')->get(); # Query DB
        $newPlaces = $places->sortByDesc('created_at')->take(3); # Query existing Collection

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
            Session::flash('message', 'The place you requested could not be found.');
            return redirect('/places/show');
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

        $places = [];

        $places = Place::orderBy('location_id', 'asc')->get(); # Query DB

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

        $placesForDropdown = Place::getPlacesForDropdown();

        $tagsForCheckboxes = Tag::getTagsForCheckboxes();

        return view('places.new')->with([
            'placesForDropdown' => $placesForDropdown,
            'tagsForCheckboxes' => $tagsForCheckboxes
        ]);

        return view('places.new');
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

        # Add new place to database
        $place = new Place();
        $place->place_name = $request->place_name;
        $place->place_image = $request->place_image;
        $place->place_link = $request->place_link;
        $place->location_id = $request->location_id;
        $place->save();

        # Now handle tags.
        # Note how the book has to be created (save) first *before* tags can
        # be added; this is because the tags need a book_id to associate with
        # and we don't have a book_id until the book is created.
        $tags = ($request->tags) ?: [];
        $place->tags()->sync($tags);
        $place->save();

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

        $place = Place::with('tags')->find($id);

        if(is_null($place)) {
            Session::flash('message', 'The place you are looking for was not found.');
            return redirect('/places');
        }

        $placesForDropdown = Place::getPlacesForDropdown();

        $tagsForCheckboxes = Tag::getTagsForCheckboxes();
        # Create a simple array of just the tag names for tags associated with this book;
        # will be used in the view to decide which tags should be checked off
        $tagsForThisPlace = [];
        foreach($place->tags as $tag) {
            $tagsForThisPlace[] = $tag->name;
        }
        # Results in an array like this: $tagsForThisBook => ['novel','fiction','classic'];
        return view('places.edit')->with([
            'id' => $id,
            'place' => $place,
            'placesForDropdown' => $placesForDropdown,
            'tagsForCheckboxes' => $tagsForCheckboxes,
            'tagsForThisPlace' => $tagsForThisPlace,
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

        # If there were tags selected...
        if($request->tags) {
            $tags = $request->tags;
        }

        # If there were no tags selected (i.e. no tags in the request)
        # default to an empty array of tags
        else {
            $tags = [];

        }

        # Above if/else could be condensed down to this: $tags = ($request->tags) ?: [];
        # Sync tags
        $place->tags()->sync($tags);
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
            return redirect('/places/showall');
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
        return redirect('/places/showall');
    }
    $place->tags()->detach();
    $place->delete();
    # Finish
    Session::flash('message', $place->place_name.' was deleted.');
    return redirect('/places/showall');
}


    /**
    * GET
    * /locations/search
    */
    public function showallLocation(Request $request) {
        $locations=[];

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
        $locationsForDropdown = Location::getLocationsForDropdown();
        return view('locations.new')->with([
            'locationsForDropdown' => $locationsForDropdown,
        ]);
    }

    /**
    * POST
    * /locations/new
    * Display the form to add a new location
    */

    public function storeNewLocation(Request $request) {
        # Custom error message
        $this->validate($request, [
            'city' => 'required|min:2|alpha',
            'state' => 'min:2|alpha',
            'country' => 'min:2|alpha',
            'location_image' => 'url',
        ]);
                # Add new location to database
            $location = new Location();
            $location->city = $request->city;
            $location->state = $request->state;
            $location->country = $request->country;
            $location->location_image = $request->location_image;
            $location->save();

            Session::flash('message', 'The location'.$request->city.' was added.');
            # Redirect the user to book index
            return redirect('/locations/showall');
            }

    /**
    * GET
    * /locations/edit
    * Display the form to add a new place
    */
    public function editLocation(Request $request) {

        $locations=[];

        $locations = Location::orderBy('city', 'asc')->get(); # Query DB
            if(is_null($locations)) {
                Session::flash('message', 'The location you are looking for was not found.');
                return redirect('/locations/showall');
        }
        return view('locations.edit')->with([
            'locations' => $locations,
        ]);
    }

    /**
    * POST
    * /locations/edit
    * Display the form to add a new place
    */
    public function saveEditsLocation(Request $request) {
        # Custom error message
        $this->validate($request, [
            'city' => 'required|min:2|alpha',
            'state' => 'min:2|alpha',
            'country' => 'min:2|alpha',
            'location_image' => 'url',
        ]);

        $location = Location::find($request->id);
        # Edit book in the database
        $location->city = $request->city;
        $Location->state = $request->state;
        $location->country = $request->country;
        $location->image = $request->location_image;

        $location->save();

        Session::flash('message', 'Your changes to '.$location->city.' were saved.');
        return redirect('/locations/show/{id}'.$request->id);
        }

    /**
    * GET
    * /places/delete
    */
    public function confirmDeletionLocation(Request $request)  {
        # Get the book they're attempting to delete
        $location = Location::find($id);
        if(!$location) {
            Session::flash('message', 'Location not found.');
            return redirect('/locatinos/search');
        }
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
            return redirect('/places/search');
        }
        $location->tags()->detach();
        $location->delete();
        # Finish
        Session::flash('message', $location->city.' was deleted.');
        return redirect('/locations/showall');
    }

}
