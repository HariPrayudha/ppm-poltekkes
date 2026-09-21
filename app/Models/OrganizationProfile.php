<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizationProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'org_chart_path',
        'duties_content',
    ];

    public function getOrgChartUrlAttribute(): string
    {
        return $this->org_chart_path ? asset('storage/'.$this->org_chart_path) : '';
    }
}
