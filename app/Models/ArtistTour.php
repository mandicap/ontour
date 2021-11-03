<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ArtistTour extends Pivot
{
    /**
     * Indicates the primary key is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;
}
