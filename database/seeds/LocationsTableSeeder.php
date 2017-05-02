<?php

use Illuminate\Database\Seeder;
use App\Location;

class LocationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        # Array of locations to add
        $locations = [
            ['Burlington', 'Vermont', 'United States', ''],
            ['Cambridge', 'Massachusetts', 'United States', 'http://www.cambridgelocalfirst.org/wp-content/uploads/2014/09/748_Crema_4.jpg'],
            ['Boston', 'Massachusetts', 'United States', ''],
            ['Shelburne', 'Vermont', 'United States',''],
            ['Chiang Mai', ' ', 'Thailand', ''],
            ['Singapore', ' ', 'Singapore', '']
        ];

        # Initiate a new timestamp we can use for created_at/updated_at fields
        $timestamp = Carbon\Carbon::now()->subDays(count($locations));

        # Loop through each author, adding them to the database
        foreach($locations as $location) {

            # Set the created_at/updated_at for each book to be one day less than
            # the book before. That way each book will have unique timestamps.
            $timestampForThisLocation = $timestamp->addDay()->toDateTimeString();
            Location::insert([
                'created_at' => $timestampForThisLocation,
                'updated_at' => $timestampForThisLocation,
                'city' => $location[0],
                'state' => $location[1],
                'country' => $location[2],
                'location_image' => $location[3],
            ]);
        }
    }
}
