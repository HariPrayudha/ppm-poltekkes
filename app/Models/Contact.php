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

    /**
     * Get clean Google Maps embed URL whether the stored value is a full <iframe> code or just a URL.
     */
    public function getMapUrlAttribute(): ?string
    {
        if (empty($this->maps_embed)) {
            return null;
        }

        if (preg_match('/src=[\"\']([^\"\']+)[\"\']/i', $this->maps_embed, $matches)) {
            return $matches[1];
        }

        return $this->maps_embed;
    }
}
