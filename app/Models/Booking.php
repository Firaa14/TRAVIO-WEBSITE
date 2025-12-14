<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'booking_code',
        'full_name',
        'phone',
        'email',
        'gender',
        'dob',
        'address',
        'guests',
        'emergency_name',
        'emergency_phone',
        'payment_method',
        'payment_proof',
        'start_date',
        'end_date',
        'total_price',
        'item_data',
        'status',
        'payment_status'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'item_data' => 'json'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFormattedPriceAttribute()
    {
        return 'Rp' . number_format($this->total_price, 0, ',', '.');
    }
}