<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Place extends Model
{
    use SoftDeletes;

    public function location() {
    # Book belongs to Author
    # Define an inverse one-to-many relationship.
    return $this->belongsTo('App\Location');
    }

    public function tags()
    {
        # With timetsamps() will ensure the pivot table has its created_at/updated_at fields automatically maintained
        return $this->belongsToMany('App\Tag')->withTimestamps();
    }

    // Get the places, and put into an array
    public static function getPlacesForDropdown() {
        $places = Place::orderBy('name', 'ASC')->get();
        # Organize the authors into an array where the key = author id and value = author name
        $placesForDropdown = [];
        foreach($places as $place) {
            $placesForDropdown[$place->id] = $place->name;
        }
        return $placesForDropdown;
    }
}
