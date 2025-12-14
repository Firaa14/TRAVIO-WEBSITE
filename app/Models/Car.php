<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $table = 'car';
    protected $fillable = [
        'title',
        'brand',
        'model',
        'year',
        'transmission',
        'fuel_type',
        'capacity',
        'color',
        'license_plate',
        'price',
        'description',
        'location',
        'image',
        'interior_image',
        'gallery_images',
        'facilities',
        'terms_conditions'
    ];

    protected $casts = [
        'facilities' => 'array',
        'gallery_images' => 'array',
        'year' => 'integer',
        'capacity' => 'integer',
        'price' => 'float',
    ];

    /**
     * Get the bookings for the car.
     */
    public function bookings()
    {
        return $this->hasMany(CarBooking::class);
    }
}
