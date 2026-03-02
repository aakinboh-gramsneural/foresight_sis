<?php

// Vercel serverless entry point for Laravel

// Set memory limit
ini_set('memory_limit', '512M');

// Define base path
define('LARAVEL_START', microtime(true));

// Determine the correct base path for Vercel
$basePath = $_ENV['LAMBDA_TASK_ROOT'] ?? dirname(__DIR__);
if (file_exists('/var/task/user')) {
    $basePath = '/var/task/user';
}

// Bootstrap Laravel
require $basePath . '/vendor/autoload.php';

$app = require_once $basePath . '/bootstrap/app.php';

// Override storage paths for /tmp
$app->useStoragePath('/tmp/storage');

// Create necessary directories
$dirs = [
    '/tmp/storage/framework/sessions',
    '/tmp/storage/framework/views',
    '/tmp/storage/framework/cache',
    '/tmp/storage/logs',
];

foreach ($dirs as $dir) {
    if (!is_dir($dir)) {
        @mkdir($dir, 0755, true);
    }
}

// Handle the request
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);
