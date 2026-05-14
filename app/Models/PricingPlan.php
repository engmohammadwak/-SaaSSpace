<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PricingPlan extends Model
{
    protected $fillable = ['name', 'price', 'billing_period', 'features', 'btn_text', 'btn_url', 'is_featured', 'is_active'];

    protected $casts = [
        'features'    => 'array',
        'is_featured' => 'boolean',
        'is_active'   => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
