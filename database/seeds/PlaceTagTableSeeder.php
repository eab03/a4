<?php

use Illuminate\Database\Seeder;
use App\Place;
use App\Tag;

class PlaceTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
        {
        # First, create an array of all the books we want to associate tags with
        # The *key* will be the book title, and the *value* will be an array of tags.
        # Note: purposefully omitting the Harry Potter books to demonstrate untagged books
        $places = [
            'Crema Cafe' => ['coffee','$$'],
            'Lake Champlain' => ['outdoors','photography','$'],
            'Shelburne Farms' => ['outdoors','photography','$'],
            'Radio Bean' => ['coffee','cocktails','food','music','$$'],
            'Boston Public Garden' => ['outdoors','photography','$'],
            'Peabody Museum of Archaeology & Ethnography at Harvard University' => ['museum','art','indoors','$']
        ];

        # Now loop through the above array, creating a new pivot for each book to tag
        foreach($places as $name => $tags) {

            // Get the place name
            $place = Place::where('name','LIKE',$name)->first();

            # Now loop through each tag for this book, adding the pivot
            foreach($tags as $tagName) {
                $tag = Tag::where('name','LIKE',$tagName)->first();

                # Connect this tag to this book
                $place->tags()->save($tag);
            }

        }
    }
}
