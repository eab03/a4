<?php

use Illuminate\Database\Seeder;
use App\Place;
use App\Location;
use App\Tag;

class PlacesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run()
     {
         # 2017-04-20: I optimized this seeder so the content is pulled from
         # the places.json file we used earlier in the semester.
         # Also made it so created_at/updated_at timestamps are unique.
         #
         # If you want to recall how it was originally done in Lecture 11:
         # https://github.com/susanBuck/fooplaces/blob/3ac08d4c6b0e45aec4e3aa380073366e3f8b6222/database/seeds/placesTableSeeder.php
         # Load json file into PHP array
         $places = json_decode(file_get_contents(database_path().'/places.json'), True);
         # Initiate a new timestamp we can use for created_at/updated_at fields
         $timestamp = Carbon\Carbon::now()->subDays(count($places));
         foreach($places as $name => $place) {
             # First, figure out the id of the author we want to associate with this place
             # Extract just the last name from the place data...
             $location = ($place['location']);
             $location_id = Location::where('city', '=', $location)->pluck('id')->first();
             # Set the created_at/updated_at for each place to be one day less than
             # the place before. That way each place will have unique timestamps.
             $timestampForThisPlace = $timestamp->addDay()->toDateTimeString();
             Place::insert([
                 'created_at' => $timestampForThisPlace,
                 'updated_at' => $timestampForThisPlace,
                 'name' => $name,
                 'location_id' => $location_id,
                 'place_image' => $place['place_image'],
                 'place_link' => $place['place_link'],
             ]);
         }
     }
 }
