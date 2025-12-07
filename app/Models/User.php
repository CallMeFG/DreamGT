<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'username',
        'email',
        'phone',
        'password',
        'role', // admin, staff, member
        'avatar',
        'google_id',
        'github_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Helper untuk cek role (Sangat berguna di Middleware nanti)
    public function hasRole($role)
    {
        return $this->role === $role;
    }

    // Relasi: Satu user punya banyak booking
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}