<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    //
    /**
     * Get the user that owns the activity.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get the customer that owns the activity.
     */
    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }
    
    /**
     * Get the movies for the activity.
     */
    public function movies()
    {
        return $this->hasMany('App\Movie');
    }
}
