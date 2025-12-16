<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OpenTripBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'open_trip_id',
        'full_name',
        'phone',
        'email',
        'gender',
        'dob',
        'address',
        'emergency_name',
        'emergency_phone',
        'participants',
        'total_price',
        'payment_method',
        'payment_proof',
        'status',
        'notes',
    ];

    protected $casts = [
        'dob' => 'date',
        'total_price' => 'decimal:2',
    ];

    /**
     * Get the user that owns the open trip booking.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the open trip that is booked.
     */
    public function openTrip(): BelongsTo
    {
        return $this->belongsTo(OpenTrip::class);
    }

    /**
     * Confirm the booking and update participant count
     */
    public function confirm()
    {
        if ($this->status !== 'confirmed') {
            $this->update(['status' => 'confirmed']);
            
            // Note: participant count is already incremented when booking is created
            // This method mainly changes status to confirmed
        }
    }

    /**
     * Cancel the booking and update participant count
     */
    public function cancel()
    {
        if ($this->status !== 'cancelled') {
            $oldStatus = $this->status;
            $this->update(['status' => 'cancelled']);
            
            // Decrease participant count
            $this->openTrip->decrement('current_participants', $this->participants);
            
            // Update trip status back to available if it was full
            $trip = $this->openTrip;
            if ($trip->status === 'full' && $trip->current_participants < $trip->max_participants) {
                $trip->update(['status' => 'available']);
            }
        }
    }
}
