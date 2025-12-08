<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'hotel_id',
        'facilities',
        'nama',
        'location',
        'description',
        'interiorImage',
        'headerImage',
        'syaratKetentuan',
        'address',
        'phone',
        'email',
        'rating',
        'price',
        'map_url',
    ];

    protected $casts = [
        'rating' => 'float',
        'price' => 'decimal:2',
    ];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    public function hotelBookings()
    {
        return $this->hasMany(HotelBooking::class);
    }
}
