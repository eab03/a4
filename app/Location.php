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
    
}
