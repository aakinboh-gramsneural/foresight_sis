<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'label',
        'value',
        'icon',
        'order',
    ];

    protected $casts = [
        'order' => 'integer',
    ];
}
