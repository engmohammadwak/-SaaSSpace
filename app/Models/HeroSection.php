<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroSection extends Model
{
    protected $fillable = [
        'badge_text',
        'main_title',
        'rotating_texts',
        'description',
        'primary_btn_text',
        'primary_btn_url',
        'secondary_btn_text',
        'secondary_btn_url',
    ];

    protected $casts = [
        'rotating_texts' => 'array',
    ];
}
