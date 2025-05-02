<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class futsal_court extends Model
{
    //
    protected $fillable = [
        'futsal_name', 'futsal_location', 'futsal_description', 'num_court', 'opening_time','closing_time','hourly_price','futsal_image','status',
        'user_id','latitude','longitude'
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
    public function vendor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
