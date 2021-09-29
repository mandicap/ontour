<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    use HasFactory;

    /**
     * Attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'on_tour'];

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
     * Gets the artist's tours.
     *
     * @return void
     */
    public function tours()
    {
        return $this->belongsToMany(Tour::class)->using(ArtistTour::class);
    }
}
