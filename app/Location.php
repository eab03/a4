<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    public function places() {
		# Author has many Books
		# Define a one-to-many relationship.
		return $this->hasMany('App\Place');
	}

    public static function getLocationsForDropdown() {
        # Get all the authors
        $locations = Location::orderBy('city', 'ASC')->get();
        # Organize the authors into an array where the key = author id and value = author name
        $locationsForDropdown = [];
        foreach($locations as $location) {
            $locationsForDropdown[$location->id] = $location->city;
        }
        return $locationsForDropdown;
    }

}
