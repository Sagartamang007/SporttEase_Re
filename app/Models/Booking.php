<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    // Specify which fields can be mass-assigned
    protected $fillable = ['user_name', 'date', 'start_time', 'end_time'];

}
