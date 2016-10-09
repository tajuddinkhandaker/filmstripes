<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User as FilmStripUser;

class Customer extends FilmStripUser
{
    //
    /**
     * Get the dvds for the customer.
     */
    public function dvds()
    {
        return $this->hasMany('App\Dvd');
    }

    /**
     * Get the activities for the customer.
     */
    public function activities()
    {
        return $this->hasMany('App\Activity');
    }
}
