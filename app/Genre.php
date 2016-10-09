<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    //
    /**
     * Get the movies for the genre.
     */
    public function movies()
    {
        return $this->hasMany('App\Movie');
    }

    /**
     * Get the boxsets for the genre.
     */
    public function boxsets()
    {
        return $this->hasMany('App\Boxset');
    }
}
