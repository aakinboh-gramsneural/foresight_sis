<?php

namespace App\Models;

use App\Models\Traits\HasImageUrl;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeroSlide extends Model
{
    use HasFactory, HasImageUrl;

    protected $fillable = [
        'title',
        'subtitle',
        'image_url',
        'cta_text',
        'cta_link',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];
}
