<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    ];
}
