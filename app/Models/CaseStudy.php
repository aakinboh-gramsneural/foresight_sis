<?php

namespace App\Models;

use App\Models\Traits\HasImageUrl;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaseStudy extends Model
{
    use HasFactory, HasImageUrl;

    protected $fillable = [
        'title',
        'description',
        'image_url',
        'order',
    ];

    protected $casts = [
        'order' => 'integer',
    ];
}
