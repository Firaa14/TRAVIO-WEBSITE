<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelRoom extends Model
{
    use HasFactory;

    protected $fillable = [
        'hotel_id',
        'room_type',
        'name',
        'description',
        'facilities',
        'price',
        'capacity',
        'max_guest',
        'bed_type',
        'room_size',
        'image',
        'status',
    ];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    public function hotelBookings()
    {
        return $this->hasMany(HotelBooking::class, 'room_id');
    }

    // Accessor untuk compatibility dengan database
    public function getCapacityAttribute()
    {
        return $this->attributes['capacity'] ?? $this->attributes['max_guest'] ?? 2;
    }

    // Accessor untuk room_type (menggunakan name sebagai room_type)
    public function getRoomTypeAttribute()
    {
        return $this->attributes['room_type'] ?? $this->attributes['name'] ?? 'Standard Room';
    }
}
