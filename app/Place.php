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

}
