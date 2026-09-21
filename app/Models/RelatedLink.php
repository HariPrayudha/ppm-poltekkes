<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelatedLink extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'logo_path',
        'url',
    ];

    public function getLogoUrlAttribute(): string
    {
        return $this->logo_path ? asset('storage/'.$this->logo_path) : '';
    }
}
