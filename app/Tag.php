<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{

    public function places() {
        return $this->belongsToMany('App\Place')->withTimestamps();
    }

    public static function getTagsForCheckboxes() {

        $tags = Tag::orderBy('name','ASC')->get();

        $tagsForCheckboxes = [];

        foreach($tags as $tag) {
            $tagsForCheckboxes[$tag['id']] = $tag->name;
        }

        return $tagsForCheckboxes;

    }

}
