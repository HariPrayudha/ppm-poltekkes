<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'address',
        'operating_hours',
        'email',
        'phone',
        'instagram_url',
        'youtube_url',
        'facebook_url',
        'maps_embed',
    ];
}
