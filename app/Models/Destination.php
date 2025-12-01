<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    protected $table = 'destination';
    public function destinasi()
    {
        return $this->belongsTo(Destinasi::class);
    }
}
