<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    protected $fillable = [
        'title',
        'price',
        'description',
        'image',
        'location',
        'facilities'
    ];

    protected $casts = [
        'facilities' => 'array',
    ];
}
