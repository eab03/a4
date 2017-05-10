<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends Model
{
    use SoftDeletes;

    public function places() {
		return $this->hasMany('App\Place');
	}

    // Get the locations, and put into an array
    public static function getLocationsForDropdown() {
        $locations = Location::orderBy('city', 'ASC')->get();
        # Organize the authors into an array where the key = author id and value = author name
        $locationsForDropdown = [];
        foreach($locations as $location) {
            $locationsForDropdown[$location->id] = $location->city. ", " .$location->state. ", " .$location->country;
        }
        return $locationsForDropdown;
    }

}
