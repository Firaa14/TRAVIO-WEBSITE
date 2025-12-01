<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelRoom extends Model
{
    use HasFactory;

    protected $fillable = [
        'hotel_id',
        'name',
        'description',
        'facilities',
        'price',
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
}
