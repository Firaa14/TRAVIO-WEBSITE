<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cart extends Model
{
    protected $fillable = [
        'user_id',
        'item_type',
        'item_id',
        'item_data',
        'quantity',
        'unit_price',
        'total_price',
        'start_date',
        'end_date',
        'guests'
    ];

    protected $casts = [
        'item_data' => 'array',
        'start_date' => 'date',
        'end_date' => 'date',
        'unit_price' => 'decimal:2',
        'total_price' => 'decimal:2'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getFormattedPriceAttribute()
    {
        return 'Rp' . number_format($this->total_price, 0, ',', '.');
    }

    public function getDurationDaysAttribute()
    {
        if (!$this->start_date || !$this->end_date) {
            return 1;
        }

        return $this->start_date->diffInDays($this->end_date) + 1;
    }
}
