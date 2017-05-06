<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
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
    
}
