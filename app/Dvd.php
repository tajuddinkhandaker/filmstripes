<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dvd extends Model
{
    //
    /**
     * Get the movies for the DVD.
     */
    public function movies()
    {
        return $this->hasMany('App\Movie');
    }

    /**
     * Get the dvdbox that owns the DVD.
     */
    public function dvdbox()
    {
        return $this->belongsTo('App\DvdBox');
    }

    /**
     * Get the borrower that owns the DVD.
     */
    public function borrower()
    {
        return $this->belongsTo('App\Borrower');
    }

    /**
     * Get the customer that owns the DVD.
     */
    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }
}
