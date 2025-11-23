<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    protected $table = 'hotels'; // sesuaikan dengan tabelmu

    protected $fillable = [
        'name',
        'title',
        'price',
        'cover_image',
        'location',
        'description',
        'rating'
    ];
}
