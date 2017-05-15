<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends Model
{

    /**
    * Deletion method
    */
    use SoftDeletes;

    /**
    * Relationship method
    * One-to-many relationship; Location has many Places
    */
    public function places() {
		return $this->hasMany('App\Place');
	}

    /**
    * Create array of locations; the key = location id, the value = city, state and/or country
    */
    public static function getLocationsForDropdown() {

        $locations = Location::orderBy('city', 'ASC')->get();

        $locationsForDropdown = [];
        foreach($locations as $location) {
            if($location->state != null) {
                $locationsForDropdown[$location->id] = $location->city. ", "
                .$location->state. ", ".$location->country;
            } else {
                $locationsForDropdown[$location->id] = $location->city. ", "
                .$location->country;
            }
        }

        return $locationsForDropdown;

    }
}
