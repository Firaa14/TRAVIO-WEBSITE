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
        'facilities',
        'itinerary',
        'price_details'
    ];

    protected $casts = [
        'facilities' => 'array',
        'itinerary' => 'array',
        'price_details' => 'array'
    ];
}
