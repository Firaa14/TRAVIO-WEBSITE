<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PlanningBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'item_data',
        'guests',
        'total_price',
        'start_date',
        'end_date',
        'status',
        'payment_proof',
    ];

    protected $casts = [
        'item_data' => 'array',
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    /**
     * Get the user that owns the planning booking.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
