<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'type',
        'approved'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function vendor()
    {
        return $this->hasOne(Vendor::class);
    }

    public function booking(){
        return $this->hasMany(Booking::class);
    }
    // Define relationship to bookings
    public function vendorBookings()
    {
        return $this->hasMany(Booking::class, 'futsal_court_id', 'id'); // Assuming futsal_court_id is the foreign key in the bookings table
    }

    // Define relationship to vendor users (if applicable)
    public function vendorUsers()
    {
        return $this->hasMany(User::class, 'vendor_id', 'id'); // Adjust according to your structure
    }
}
