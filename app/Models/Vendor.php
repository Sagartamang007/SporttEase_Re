<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Vendor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'company_name',
        'document',
        'pan_card',
        'pan_card_image',
        'front_citizenship_document',
        'back_citizenship_document',
        'status',
        'user_id'
    ];



        public function user()
        {
            return $this->belongsTo(User::class);
        }

}
