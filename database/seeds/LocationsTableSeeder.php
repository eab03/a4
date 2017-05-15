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
            ['Burlington', 'VT', 'USA', 'https://s3.amazonaws.com/dwa/Burlington+Lake+Champlain_3.jpg', 'Gorgeous sunsets over Lake Champlain!'],
            ['Cambridge', 'MA', 'USA', 'https://s3.amazonaws.com/dwa/Cambridge.jpg', 'There is usually not this much snow.'],
            ['Boston', 'MA', 'USA', 'https://s3.amazonaws.com/dwa/Boston.jpg', 'Always something going on.'],
            ['Shelburne', 'VT', 'USA', 'https://s3.amazonaws.com/dwa/Shelburne.jpg', 'Apples, Apples, Apples!'],
            ['Bangkok', '', 'Thailand', 'https://s3.amazonaws.com/dwa/Bangkok.jpg', 'Look forward to going back! Awesome street food!'],
            ['Ubud', 'Bali', 'Indonesia', 'https://s3.amazonaws.com/dwa/Bali.jpg', 'Delightful. And the monkeys!'],
            ['Singapore', '', 'Singapore', 'https://s3.amazonaws.com/dwa/Singapore_3.jpg', 'Interesting place.'],
            ['Gili Meno', 'Lombok', 'Indonesia', 'https://s3.amazonaws.com/dwa/Gili+Meno.jpg', 'Lovely place. No cars are allowed on the island, and all travel takes place by horse cart, boat, bicycle or on foot.']
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
                'location_notes' => $location[4],
            ]);
        }
    }
}
