<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'on_tour'];

    /**
     * Tours that belong to an artist
     *
     * @return  \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tours()
    {
        return $this->belongsToMany(Tour::class)->using(ArtistTour::class);
    }
}
