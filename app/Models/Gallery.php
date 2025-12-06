<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'location',
        'caption',
        'image',
    ];

    /**
     * Get the user that owns the gallery post.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
