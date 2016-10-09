<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    //
    /**
     * Get the boxset that owns the movie.
     */
    public function boxset()
    {
        return $this->belongsTo('App\Boxset');
    }

    /**
     * Get the dvd that owns the movie.
     */
    public function dvd()
    {
        return $this->belongsTo('App\Dvd');
    }

    /**
     * Get the genre that owns the movie.
     */
    public function genre()
    {
        return $this->belongsTo('App\Genre');
    }
}
