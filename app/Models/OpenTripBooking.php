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
}
