<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'bookable_id',
        'bookable_type',
        'start_time',
        'end_time',
        'total_price',
        'status', // pending, confirmed, completed, cancelled
        'payment_method',
        'payment_proof'
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    // Relasi: Booking ini milik siapa?
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi Polymorphic: Booking ini untuk apa? (PC atau Arena?)
    public function bookable()
    {
        return $this->morphTo();
    }
    // --- ADAPTASI DARI PROYEK V1 ---
    public function scopeFilter($query, array $filters)
    {
        // 1. Search (Cari Nama User, Email, atau ID Booking)
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where(function ($q) use ($search) {
                $q->where('id', 'like', '%' . $search . '%') // Cari ID
                    ->orWhereHas('user', function ($userQuery) use ($search) {
                        $userQuery->where('name', 'like', '%' . $search . '%') // Cari Nama
                            ->orWhere('email', 'like', '%' . $search . '%');   // Cari Email
                    });
            });
        });

        // 2. Filter Status
        $query->when($filters['status'] ?? false, function ($query, $status) {
            if ($status !== 'all' && $status !== '') {
                return $query->where('status', $status);
            }
        });
    }
}