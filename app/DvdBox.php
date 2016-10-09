<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DvdBox extends Model
{
    //
    /**
     * Get the dvds for the dvd box.
     */
    public function dvds()
    {
        return $this->hasMany('App\Dvd');
    }
}
