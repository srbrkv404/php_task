<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Hotel extends Model
{
    protected $fillable = [
        'name', 'address', 'city', 'stars', 'description'
    ];

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }
}
