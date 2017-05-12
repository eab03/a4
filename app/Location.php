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
                if($location->state != null) {
                    $locationsForDropdown[$location->id] = $location->city. ", ".$location->state. ", ".$location->country;
                } else {
                    $locationsForDropdown[$location->id] = $location->city. ", ".$location->country;
                }
            }
            return $locationsForDropdown;
    }
}
