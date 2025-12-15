<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DestinationBooking extends Model
{
    protected $fillable = [
        'booking_id',
        'destination_id',
        'user_id',
        'full_name',
        'phone',
        'email',
        'gender',
        'dob',
        'address',
        'emergency_name',
        'emergency_phone',
        'trip_title',
        'trip_date',
        'price_per_person',
        'participants',
        'total_price',
        'payment_method',
        'payment_proof',
        'status'
    ];

    protected $casts = [
        'dob' => 'date',
        'price_per_person' => 'decimal:2',
        'total_price' => 'decimal:2',
    ];

    // Relasi ke destinasi
    public function destinasi()
    {
        return $this->belongsTo(\App\Models\Destinasi::class, 'destination_id');
    }

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Generate booking ID otomatis
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->booking_id)) {
                $model->booking_id = 'DEST-' . strtoupper(uniqid());
            }
        });
    }
}