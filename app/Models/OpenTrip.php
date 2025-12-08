<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OpenTrip extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'location',
        'description',
        'image',
        'price',
        'start_date',
        'end_date',
        'duration_days',
        'max_participants',
        'current_participants',
        'facilities',
        'itinerary',
        'meeting_point',
        'meeting_time',
        'status',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'start_date' => 'date',
        'end_date' => 'date',
        'meeting_time' => 'datetime:H:i',
        'facilities' => 'array',
        'itinerary' => 'array',
    ];

    /**
     * Get all bookings for this open trip.
     */
    public function bookings(): HasMany
    {
        return $this->hasMany(OpenTripBooking::class);
    }

    /**
     * Get confirmed bookings only.
     */
    public function confirmedBookings(): HasMany
    {
        return $this->hasMany(OpenTripBooking::class)->where('status', 'confirmed');
    }

    /**
     * Check if trip is still available for booking.
     */
    public function isAvailable(): bool
    {
        return $this->status === 'available' && $this->current_participants < $this->max_participants;
    }

    /**
     * Get available slots.
     */
    public function getAvailableSlots(): int
    {
        return $this->max_participants - $this->current_participants;
    }
}
