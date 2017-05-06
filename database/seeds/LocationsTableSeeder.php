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
            ['Burlington', 'VT', 'USA', 'https://c1.staticflickr.com/4/3291/3490513749_6e7c58dc47_b.jpg'],
            ['Cambridge', 'MA', 'USA', 'http://www.cambridgelocalfirst.org/wp-content/uploads/2014/09/748_Crema_4.jpg'],
            ['Boston', 'MA', 'USA', 'https://previews.123rf.com/images/coleong/coleong0611/coleong061100297/615031-View-of-Boston-Public-Garden-in-spring-Stock-Photo.jpg'],
            ['Shelburne', 'VT', 'USA', 'http://inthekitchenwithbronwyn.com/wp-content/uploads/Farm-Barn-at-Shelburne-Farms.jpg'],
            ['Bangkok', ' ', 'Thailand', ''],
            ['Chiang Mai', ' ', 'Thailand', 'https://cache-graphicslib.viator.com/graphicslib/thumbs360x240/43977/SITours/amazing-trekking-at-doi-inthanon-national-park-and-hmong-hill-tribe-in-chiang-mai-393987.jpg'],
            ['Singapore', ' ', 'Singapore', 'http://lghttp.60358.nexcesscdn.net/8046264/images/page/-/100rc/img/cities/Singapore%20hero%20cro.jpg']
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
