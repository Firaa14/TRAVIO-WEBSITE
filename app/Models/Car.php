<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $table = 'car';
    protected $fillable = [
        'title',
        'price',
        'description',
        'image',
        'facilities'
    ];

    protected $casts = [
        'facilities' => 'array',
    ];
}
