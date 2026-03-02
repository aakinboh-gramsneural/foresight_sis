<?php

namespace App\Models;

use App\Models\Traits\HasImageUrl;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceSection extends Model
{
    use HasFactory, HasImageUrl;

    protected $fillable = [
        'tag',
        'title',
        'description',
        'image_url',
        'order',
        'items',
    ];

    protected $casts = [
        'items' => 'array',
        'order' => 'integer',
    ];
}
