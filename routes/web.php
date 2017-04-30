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

Route::get('/', 'WelcomeController');

Route::get('/happenings', 'EventController@index');

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
