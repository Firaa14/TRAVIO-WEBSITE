<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackageBooking extends Model
{
    protected $table = 'package_bookings';

    protected $fillable = [
        'user_id',
        'package_id',
        'travel_date',
        'number_of_travelers',
        'total_price',
        'customer_name',
        'customer_email',
        'customer_phone',
        'special_requests',
        'status',
        'booking_code'
    ];

    protected $casts = [
        'travel_date' => 'date',
        'total_price' => 'decimal:2'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}