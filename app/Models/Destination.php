<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    protected $table = 'destinations';
    public function destinasi()
    {
        return $this->belongsTo(Destinasi::class);
    }
}
