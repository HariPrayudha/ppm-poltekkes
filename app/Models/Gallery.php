<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $table = 'gallery';

    protected $fillable = [
        'image_path',
        'title',
        'event_date',
        'description',
    ];

    protected function casts(): array
    {
        return [
            'event_date' => 'date',
        ];
    }

    public function getImageUrlAttribute(): string
    {
        return $this->image_path ? asset('storage/'.$this->image_path) : '';
    }
}
