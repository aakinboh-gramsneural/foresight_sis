<?php

// Vercel serverless function entry point

// Set storage path to /tmp for serverless
$_ENV['APP_STORAGE'] = '/tmp';

// Ensure required directories exist in /tmp
$dirs = ['/tmp/framework/sessions', '/tmp/framework/views', '/tmp/framework/cache'];
foreach ($dirs as $dir) {
    if (!is_dir($dir)) {
        @mkdir($dir, 0755, true);
    }
}

// Forward to Laravel's public index
require __DIR__ . '/../public/index.php';
