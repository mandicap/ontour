<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    /**
     * Attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'active'];

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
     * Gets the tour's artists.
     *
     * @return void
     */
    public function artists()
    {
        return $this->belongsToMany(Artist::class)->using(ArtistTour::class);
    }

    /**
     * Gets the tour's venues.
     *
     * @return void
     */
    public function venues()
    {
        return $this->belongsToMany(Venue::class)->using(TourVenue::class);
    }
}
