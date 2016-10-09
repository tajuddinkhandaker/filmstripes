<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Boxset extends Model
{
    //
    /**
     * Get the movies for the boxset.
     */
    public function movies()
    {
        return $this->hasMany('App\Movie');
    }

    /**
     * Get the genre that owns the boxset.
     */
    public function genre()
    {
        return $this->belongsTo('App\Genre');
    }
}
