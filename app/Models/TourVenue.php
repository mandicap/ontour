<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class TourVenue extends Pivot
{
    /**
     * Indicates the primary key is auto incrementing.
     *
     * @var boolean
     */
    public $incrementing = true;

    /**
     * Attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'date_time',
        'created_at',
        'updated_at'
    ];
}
