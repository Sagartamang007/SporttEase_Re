<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str; // Make sure to import Str

class Blog extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'image'];

    // Method to get an excerpt of the content
    public function getExcerpt($length = 150)
    {
        return Str::limit($this->content, $length); // You can change the length of the excerpt here
    }
}
