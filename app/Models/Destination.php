<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    protected $table = 'destinations';

    protected $fillable = [
        'destinasi_id',
        'location',
        'detail',
        'itinerary',
        'price_details'
    ];

    protected $casts = [
        'itinerary' => 'array',
        'price_details' => 'array',
    ];

    public function destinasi()
    {
        return $this->belongsTo(Destinasi::class);
    }
}
