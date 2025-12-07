<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arena extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'capacity',
        'facilities',
        'price_per_hour',
        'image_path',
        'status'
    ];

    // Relasi Polymorphic: Arena ini bisa dibooking
    public function bookings()
    {
        return $this->morphMany(Booking::class, 'bookable');
    }
}