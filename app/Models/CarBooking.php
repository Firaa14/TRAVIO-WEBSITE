<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'car_id',
        'start_date',
        'end_date',
        'passengers',
        'duration_type',
        'with_driver',
        'renter_name',
        'driver_name',
        'ktp_path',
        'sim_path',
        'total_price',
        'status',
        'notes',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'with_driver' => 'boolean',
        'total_price' => 'decimal:2',
    ];

    /**
     * Get the user that owns the booking.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the car associated with the booking.
     */
    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    /**
     * Calculate the number of days for the booking.
     */
    public function getDaysAttribute()
    {
        return $this->start_date->diffInDays($this->end_date);
    }

    /**
     * Get the formatted total price.
     */
    public function getFormattedTotalPriceAttribute()
    {
        return 'Rp ' . number_format($this->total_price, 0, ',', '.');
    }
}