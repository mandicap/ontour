<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ArtistTour extends Pivot
{
    /**
     * Indicates that primary key is auto incrementing.
     *
     * @var boolean
     */
    public $incrementing = true;
}
