<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pc extends Model
{
    use HasFactory;

    protected $fillable = [
        'pc_type_id',
        'pc_number',
        'specifications',
        'status' // available, booked, maintenance
    ];

    // Relasi: PC ini jenisnya apa?
    public function type()
    {
        return $this->belongsTo(PcType::class, 'pc_type_id');
    }

    // Relasi Polymorphic: PC ini bisa dibooking
    public function bookings()
    {
        return $this->morphMany(Booking::class, 'bookable');
    }
}