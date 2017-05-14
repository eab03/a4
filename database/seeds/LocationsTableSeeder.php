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
            ['Burlington', 'VT', 'USA', 'https://c1.staticflickr.com/4/3291/3490513749_6e7c58dc47_b.jpg', 'Great sunsets!'],
            ['Cambridge', 'MA', 'USA', 'http://www.cambridgelocalfirst.org/wp-content/uploads/2014/09/748_Crema_4.jpg', 'Check out Mt. Auburn Cemetery'],
            ['Boston', 'MA', 'USA', 'https://previews.123rf.com/images/coleong/coleong0611/coleong061100297/615031-View-of-Boston-Public-Garden-in-spring-Stock-Photo.jpg', 'Summertime fun.'],
            ['Shelburne', 'VT', 'USA', 'http://inthekitchenwithbronwyn.com/wp-content/uploads/Farm-Barn-at-Shelburne-Farms.jpg', 'Beautiful!'],
            ['Bangkok', '', 'Thailand', 'https://www.azamaraclubcruises.com/sites/default/files/heros/klong-toey-thailand_3.jpg', 'Look forward to going back! Awesome street food!'],
            ['Ubud', 'Bali', 'Indonesia', 'https://s-media-cache-ak0.pinimg.com/originals/20/17/47/201747d68d8ca306c9e3d2f03ff6a6f7.jpg', 'Delightful. And the monkeys!'],
            ['Singapore', '', 'Singapore', 'http://lghttp.60358.nexcesscdn.net/8046264/images/page/-/100rc/img/cities/Singapore%20hero%20cro.jpg', 'Interesting place.']
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
