<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $table = 'package';

    protected $fillable = [
        'title',
        'price',
        'description',
        'image',
        'location',
        'duration',
        'include',
        'exclude',
        'facilities',
        'itinerary',
        'price_details',
        'terms_conditions'
    ];

    protected $casts = [
        'facilities' => 'array',
        'itinerary' => 'array',
        'price_details' => 'array'
    ];
}
