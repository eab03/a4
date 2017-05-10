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
Route::get('/places/show/{id?}', 'PlaceController@showPlace');

# Get route to show an individual place
Route::get('/places/showall', 'PlaceController@showAllPlace');

# Get route to show form to search page
Route::get('/places/search', 'PlaceController@searchPlace');



# Get route to show a form to create a new place
Route::get('/places/new', 'PlaceController@createNewPlace');

# Post route to process the form to add a new place
Route::post('/places/new', 'PlaceController@storeNewPlace');

# Get route to show a form to edit an existing place
Route::get('/places/edit/{id}', 'PlaceController@editPlace');

# Post route to process the form to save edits to a place
Route::post('/places/edit', 'PlaceController@saveEditsPlace');

# Get route to confirm deletion of place
Route::get('/places/delete/{id}', 'PlaceController@confirmDeletionPlace');

# Post route to actually destroy the place
Route::post('/places/delete', 'PlaceController@deletePlace');



// Locations

# Get route to show an individual place
Route::get('/locations/show/{id?}', 'PlaceController@showLocation');

# Get route to show all locations
Route::get('/locations/showall', 'PlaceController@showAllLocation');


# Get route to show a form to create a new location
Route::get('/locations/new', 'PlaceController@createNewLocation');

# Post route to process the form to add a new place
Route::post('/locations/new', 'PlaceController@storeNewLocation');

# Get route to show a form to edit an existing place
Route::get('/locations/edit/{id}', 'PlaceController@editLocation');

# Post route to process the form to save edits to a place
Route::post('/locations/edit', 'PlaceController@saveEditsLocation');

# Get route to confirm deletion of location
Route::get('/locations/delete/{id}', 'PlaceController@confirmDeletionLocation');

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

Route::get('/debug', function() {

	echo '<pre>';

	echo '<h1>Environment</h1>';
	echo App::environment().'</h1>';

	echo '<h1>Debugging?</h1>';
	if(config('app.debug')) echo "Yes"; else echo "No";

	echo '<h1>Database Config</h1>';
    	echo 'DB defaultStringLength: '.Illuminate\Database\Schema\Builder::$defaultStringLength;
    	/*
	The following commented out line will print your MySQL credentials.
	Uncomment this line only if you're facing difficulties connecting to the database and you
        need to confirm your credentials.
        When you're done debugging, comment it back out so you don't accidentally leave it
        running on your production server, making your credentials public.
        */
	//print_r(config('database.connections.mysql'));

	echo '<h1>Test Database Connection</h1>';
	try {
		$results = DB::select('SHOW DATABASES;');
		echo '<strong style="background-color:green; padding:5px;">Connection confirmed</strong>';
		echo "<br><br>Your Databases:<br><br>";
		print_r($results);
	}
	catch (Exception $e) {
		echo '<strong style="background-color:crimson; padding:5px;">Caught exception: ', $e->getMessage(), "</strong>\n";
	}

	echo '</pre>';

});
