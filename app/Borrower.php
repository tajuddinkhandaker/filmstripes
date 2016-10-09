<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Borrower extends Model
{
    //
    /**
     * Get the dvds for the borrower.
     */
    public function dvds()
    {
        return $this->hasMany('App\Dvd');
    }
}
