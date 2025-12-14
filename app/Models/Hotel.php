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
    
    public function hotelDetails()
    {
        return $this->hasMany(HotelDetail::class);
    }
    
    public function hotelRooms()
    {
        return $this->hasMany(HotelRoom::class);
    }
    
    public function hotelBookings()
    {
        return $this->hasMany(HotelBooking::class);
    }
}
