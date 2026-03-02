<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FooterSetting extends Model
{
    use HasFactory;

    protected $table = 'footer_settings';

    protected $fillable = [
        'tagline',
        'disclaimer',
        'social_links',
    ];

    protected $casts = [
        'social_links' => 'array',
    ];
}
