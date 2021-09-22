<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    /**
     * Attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'location'];

    /**
     * Attributes to be excluded from JSON form of model.
     *
     * @var array
     */
    protected $hidden = [];
}
