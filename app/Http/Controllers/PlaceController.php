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
    * /places
    * Home page that lists 3 recently updated places and locations
    */
    public function index(Request $request) {

        $locations = Location::orderBy('updated_at', 'descending')->limit(3)->get();

        $places = Place::orderBy('name', 'descending')->get();
        $newPlaces = $places->sortByDesc('updated_at')->take(3);

        return view('places.index')->with([
            'locations' => $locations,
            'newPlaces' => $newPlaces,
        ]);
    }

    /**
    * GET
    * /places/show/{id}
    * Show information for one place with associated tags
    */
    public function showPlace($id) {

        $place = Place::find($id);

        if(!$place) {
            Session::flash('message', 'The place you are looking for could not be found.');
            return redirect('/places/showall');
        } else {

            $tagsForThisPlace = [];
            foreach($place->tags as $tag) {
                $tagsForThisPlace[] = $tag->name;
            }
        }

        return view('places.show')->with([
            'place' => $place,
            'tagsForThisPlace' => $tagsForThisPlace
        ]);
    }

    /**
    * GET
    * /places/showall
    * Show list of all places in alpha order
    */
    public function showallPlace(Request $request) {

        $places = Place::orderBy('name', 'asc')->get();

        return view('places.showall')->with([
            'places' => $places,
        ]);
    }

    /**
    * GET
    * /places/search
    * Query to show select information one place based on text input
    */
    public function searchPlace(Request $request) {

        $locations= Location::orderBy('city', 'asc')->get();

        $places = Place::orderBy('name', 'asc')->get();

        $searchResults = [];

        $searchPlace = $request->input('searchPlace', null);

        # If entry in the search field, continue to query for a match
        if($searchPlace) {

            # Seed data from json file
            $placesRawData = file_get_contents(database_path().'/places.json');
            $places = json_decode($placesRawData, true);

            foreach($places as $name => $place) {
                # Case sensitive check for exact match
                if($request->has('caseSensitive')) {
                    $match = $name == $searchPlace;
                }
                # Case insensitive check for exact match
                else {
                    $match = strtolower($name) == strtolower($searchPlace);
                }

                # Add name to list of search results if exact match
                if($match) {
                    $searchResults[$name] = $place;
                }
            }
        }

        return view('places.search')->with([
            'caseSensitive' => $request->has('caseSensitive'),
            'locations' => $locations,
            'places' => $places,
            'searchPlace' => $searchPlace,
            'searchResults' => $searchResults,
        ]);
    }

    /**
    * GET
    * /places/new
    * Display form to add new place
    */
    public function createNewPlace(Request $request) {

        $locationsForDropdown = Location::getLocationsForDropdown();

        $tagsForCheckboxes = Tag::getTagsForCheckboxes();

        return view('places.new')->with([
            'locationsForDropdown' => $locationsForDropdown,
            'tagsForCheckboxes' => $tagsForCheckboxes
        ]);
    }

    /**
    * POST
    * /places/new
    * Process form to add new place
    */
    public function storeNewPlace(Request $request) {

        # Custom error message
        $messages = [
            'location_id.not_in' => 'Location not selected.',
        ];

        # Validate fields
        $this->validate($request, [
            'name' => 'required|min:1',
            'place_image' => 'nullable|url|max:191',
            'place_link' => 'nullable|url',
            'place_notes' => 'nullable|max:1000',
            'location_id' => 'not_in:0',
        ], $messages);

        # Add and save new place and associated tags to the database
        $place = new Place();
        $place->name = $request->name;
        $place->place_link = $request->place_link;
        $place->place_image = $request->place_image;
        $place->place_notes = $request->place_notes;
        $place->location_id = $request->location_id;
        $place->save();

        # If there are tags, get and synch the tags; if no tags revert to empty array
        $tags = ($request->tags) ?: [];
        $place->tags()->sync($tags);
        $place->save();

        Session::flash('message', "The place '$request->name' was added.");
        return redirect('/places');
    }

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

        # Array of associated tag names, which will be shown in the view
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
    }

    /**
    * POST
    * /places/edit/{id}
    * Process form to edit place fields
    */
    public function saveEditsPlace(Request $request) {

        # Custom error message
        $messages = [
            'location_id.not_in' => 'Location not selected.',
        ];

        # Validate fields
        $this->validate($request, [
            'name' => 'required|min:1',
            'place_image' => 'nullable|url|max:191',
            'place_link' => 'nullable|url',
            'place_notes' => 'nullable|max:1000',
            'location_id' => 'not_in:0',
        ], $messages);

        $place = Place::find($request->id);

        # Edit and save place in the database
        $place->name = $request->name;
        $place->place_image = $request->place_image;
        $place->place_link = $request->place_link;
        $place->place_notes = $request->place_notes;
        $place->location_id = $request->location_id;

        # If there are tags, get the tags; if no tags revert to empty array
        $tags = ($request->tags) ?: [];

        # Sync tags
        $place->tags()->sync($tags);
        $place->save();

        Session::flash('message', "Your changes to '$place->name' were saved.");
        return redirect('/places/show/'.$request->id);
    }

    /**
    * GET
    * /places/delete/{id}
    * Page to confirm deletion
    */
    public function confirmDeletionPlace($id)  {

        # Get the place attempted to be deleted
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
    * Delete the place
    */
    public function deletePlace(Request $request)  {

        # Get the place to be deleted
        $place = Place::find($request->id);

            if(!$place) {
                Session::flash('message', 'Deletion failed; place not found.');
                return redirect('/places');
            }

            $place->tags()->detach();

            $place->delete();

        Session::flash('message', "'$place->name' was deleted.");
        return redirect('/places/showall');
    }

    //////////////////////////////////////////////////////////////

    /**
    * GET
    * /locations/showall
    * Page to show all locations in alpha order by city name
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
    * Page to show select information for a single location
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
    }

    /**
    * GET
    * /locations/new
    * Display form to add new location
    */
    public function createNewLocation(Request $request) {
        return view('locations.new');
    }

    /**
    * POST
    * /locations/new
    * Process form to add new location
    */

    public function storeNewLocation(Request $request) {

        # Custom error message
        $messages = [];

        # Validate fields
        $this->validate($request, [
            'city' => 'required|min:1',
            'state' => 'nullable|min:2',
            'country' => 'required|min:2',
            'location_image' => 'nullable|url',
            'location_notes' => 'nullable|max:1000',
        ], $messages);

        # Add and save new location to the database
        $location = new Location();
        $location->city = $request->city;
        $location->state = $request->state;
        $location->country = $request->country;
        $location->location_image = $request->location_image;
        $location->location_notes = $request->location_notes;
        $location->save();

        Session::flash('message', "The location '$request->city' was added.");
        return redirect('/places');
    }

    /**
    * GET
    * /locations/edit{id}
    * Display form to edit location
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
    */
    public function saveEditsLocation(Request $request) {

        # Custom error message
        $messages = [];

        # Validate fiels
        $this->validate($request, [
            'city' => 'required|min:1',
            'state' => 'nullable|min:2',
            'country' => 'required|min:2',
            'location_image' => 'nullable|url',
            'location_notes' => 'nullable|max:1000',
        ], $messages);

        $location = Location::find($request->id);

        # Edit and save location in the database
        $location->city = $request->city;
        $location->state = $request->state;
        $location->country = $request->country;
        $location->location_image = $request->location_image;
        $location->location_notes = $request->location_notes;
        $location->save();

        Session::flash('message', "Your changes to '$location->city' were saved.");
        return redirect('/locations/show/'.$request->id);
    }

    /**
    * GET
    * /places/delete
    * Page to confirm deletion
    */
    public function confirmDeletionLocation($id)  {

        $location = Location::find($id);

        if(!$location) {
            Session::flash('message', 'Location not found.');
            return redirect('/places');
        }

        return view('locations.delete')->with('location', $location);
    }

    /**
    * POST
    * /places/delete
    * Page to delete the location
    */
    public function deleteLocation(Request $request)  {

        # Get the location to be deleted
        $locations = Location::find($request->id);

        $places = Place::orderBy('location_id', 'asc')->get(); # Query DB

            foreach($places as $name => $place) {
                foreach($locations as $city => $location) {
                    if($match = $request->id == $place->location_id) {
                        Session::flash('message', "Deletion failed; delete any associated places in '$locations->city' first.");
                        return redirect('/locations/showall');
                    }
                }
            }

        if(!$locations) {
            Session::flash('message', 'Deletion failed; place not found.');
            return redirect('/locations/showall');
        }

        $locations->delete();

        Session::flash('message', "'$locations->city' was deleted.");
        return redirect('/locations/showall');
    }
}
