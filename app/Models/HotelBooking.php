<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HotelBooking extends Model
{
    use HasFactory;

    protected $table = 'hotel_bookings';

    protected $fillable = [
        'hotel_id',
        'room_id',
        'user_id',
        'check_in',
        'check_out',
        'guests',
        'total_price',
        'status'
    ];

    protected $casts = [
        'check_in' => 'date',
        'check_out' => 'date',
        'total_price' => 'decimal:2'
    ];

    /**
     * Get the hotel detail that owns the booking.
     */
    public function hotelDetail(): BelongsTo
    {
        return $this->belongsTo(HotelDetail::class, 'hotel_id');
    }

    /**
     * Get the hotel room that owns the booking.
     */
    public function hotelRoom(): BelongsTo
    {
        return $this->belongsTo(HotelRoom::class, 'room_id');
    }

    /**
     * Get the user that owns the booking.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Calculate the number of nights between check-in and check-out.
     */
    public function getNightsAttribute(): int
    {
        return $this->check_in->diffInDays($this->check_out);
    }

    /**
     * Scope a query to only include pending bookings.
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope a query to only include confirmed bookings.
     */
    public function scopeConfirmed($query)
    {
        return $query->where('status', 'confirmed');
    }

    /**
     * Scope a query to only include cancelled bookings.
     */
    public function scopeCancelled($query)
    {
        return $query->where('status', 'cancelled');
    }
}