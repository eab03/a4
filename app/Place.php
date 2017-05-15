<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Place extends Model
{

    /**
    * Deletion method
    */
    use SoftDeletes;

    /**
    * Relationship method
    * Inverse one-to-many relationship; Place belongs to Location
    */
    public function location() {
        return $this->belongsTo('App\Location');
    }

    /**
    *
    */
    public function tags() {
        return $this->belongsToMany('App\Tag')->withTimestamps();
    }


    /**
    * Create array of places; the key = place id, the value = place name
    */
    public static function getPlacesForDropdown() {

        $places = Place::orderBy('name', 'ASC')->get();

        $placesForDropdown = [];
        foreach($places as $place) {
            $placesForDropdown[$place->id] = $place->name;
        }
        
        return $placesForDropdown;

    }
}
