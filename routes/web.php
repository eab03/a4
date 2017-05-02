<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Welcome Page

Route::get('/', 'WelcomeController');


// Places

Route::get('/places', 'PlaceController@index');

# Get route to show an individual place
Route::get('/places/show', 'PlaceController@showPlace');

# Get route to show an individual place
Route::get('/places/show{id}', 'PlaceController@showPlace');

# Get route to show form to search page
Route::get('/places/search', 'PlaceController@searchPlace');

# Get route to show form to search page
Route::get('/places/search{id}', 'PlaceController@searchPlace');

# Get route to show a form to create a new place
Route::get('/places/new', 'PlaceController@createNewPlace');

# Post route to process the form to add a new place
Route::post('/places/new', 'PlaceController@storeNewPlace');

# Get route to show a form to edit an existing place
Route::get('/places/edit/', 'PlaceController@editPlace');

# Post route to process the form to save edits to a place
Route::post('/places/edit', 'PlaceController@saveEditsPlace');

# Get route to confirm deletion of place
Route::get('/places/delete/', 'PlaceController@confirmDeletionPlace');

# Post route to actually destroy the place
Route::post('/places/delete', 'PlaceController@deletePlace');


// Locations

# Get route to show an individual place
Route::get('/locations/show', 'PlaceController@showLocation');

# Get route to show an individual place
Route::get('/locations/show{id}', 'PlaceController@showLocation');

# Get route to a search page
Route::get('locations/search{id}', 'PlaceController@searchLocation');

# Get route to a search page
Route::get('locations/search', 'PlaceController@searchLocation');

# Get route to show a form to create a new location
Route::get('/locations/new', 'PlaceController@createNewLocation');

# Post route to process the form to add a new place
Route::post('/locations/new', 'PlaceController@storeNewLocation');

# Get route to show a form to edit an existing place
Route::get('/locations/edit', 'PlaceController@editLocation');

# Post route to process the form to save edits to a place
Route::post('/locations/edit', 'PlaceController@saveEditsLocation');

# Get route to confirm deletion of location
Route::get('/locations/delete', 'PlaceController@confirmDeletionLocation');

# Post route to actually destroy the location
Route::post('/locations/delete', 'PlaceController@deleteLocation');

/**
* Log viewer
* (only accessible locally)
*/
if(config('app.env') == 'local') {
    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

    if(App::environment('local')) {

        Route::get('/drop', function() {

            DB::statement('DROP database a4');
            DB::statement('CREATE database a4');

            return 'Dropped a4; created a4.';
        });

    };

}
