<?php

use Illuminate\Database\Seeder;
use App\Tag;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = ['indoors', 'outdoors', 'photography', 'museum', 'art', 'music', 'class', 'talk', 'coffee', 'cocktails', 'food', '$', '$$', '$$$'];

        foreach($tags as $tagName) {
            $tag = new Tag();
            $tag->name = $tagName;
            $tag->save();
        }
    }
}
