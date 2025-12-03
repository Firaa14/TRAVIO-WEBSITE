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
        'include',
        'facilities',
        'itinerary',
        'duration',
        'location'
    ];

    protected $casts = [
        'facilities' => 'array',
        'itinerary' => 'array'
    ];
}
