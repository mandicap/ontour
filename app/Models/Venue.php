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

    /**
     * Attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    /**
     * Gets the venue's tours.
     *
     * @return void
     */
    public function tours()
    {
        return $this->belongsToMany(Tour::class)->using(TourVenue::class);
    }
}
