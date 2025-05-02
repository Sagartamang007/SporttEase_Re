<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    // Specify which fields can be mass-assigned
    protected $fillable = ['user_id', 'futsal_court_id', 'date', 'start_time', 'end_time', 'status', 'payment_method'];



    public function user(){
        return $this->belongsTo(User::class);
    }
    // public function futsal_court(){
    //     return $this->belongsTo(futsal_court::class);
    // }
    public function futsal_Court()
    {
        return $this->belongsTo(futsal_court::class, 'futsal_court_id');
    }



}
