<?php

namespace App\Models\Traits;

use Illuminate\Support\Facades\Storage;

trait HasImageUrl
{
    /**
     * Get the resolved image URL.
     * Handles both static paths (/images/...) and uploaded files (directory/file.jpg).
     */
    public function getImageAttribute(): ?string
    {
        $url = $this->attributes['image_url'] ?? null;

        if (!$url) {
            return null;
        }

        // Already an absolute URL or starts with /images (static file)
        if (str_starts_with($url, 'http') || str_starts_with($url, '/images')) {
            return $url;
        }

        // Uploaded file via Filament - stored in public disk
        return Storage::disk('public')->url($url);
    }
}
