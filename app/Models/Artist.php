<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    /**
     * Attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * Attributes to be excluded from JSON form of model.
     *
     * @var array
     */
    protected $hidden = [];
}
