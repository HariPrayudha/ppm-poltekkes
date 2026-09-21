<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Greeting extends Model
{
    use HasFactory;

    protected $table = 'greeting';

    protected $fillable = [
        'photo_path',
        'name',
        'position',
        'content',
    ];

    public function getPhotoUrlAttribute(): string
    {
        return $this->photo_path ? asset('storage/'.$this->photo_path) : '';
    }
}
