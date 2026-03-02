<?php

// Vercel serverless entry point for Laravel

// Set memory limit
ini_set('memory_limit', '512M');

// Define base path
define('LARAVEL_START', microtime(true));

// Set up paths for serverless
$_ENV['APP_BASE_PATH'] = $_ENV['LAMBDA_TASK_ROOT'] ?? dirname(__DIR__);

// Bootstrap Laravel
require $_ENV['APP_BASE_PATH'] . '/vendor/autoload.php';

$app = require_once $_ENV['APP_BASE_PATH'] . '/bootstrap/app.php';

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
