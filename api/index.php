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

// Check if vendor exists
if (!file_exists($basePath . '/vendor/autoload.php')) {
    http_response_code(500);
    die('Error: Composer autoload not found at: ' . $basePath . '/vendor/autoload.php');
}

// Bootstrap Laravel
require $basePath . '/vendor/autoload.php';

// Check for APP_KEY
if (!getenv('APP_KEY') && !isset($_ENV['APP_KEY'])) {
    http_response_code(500);
    die('Error: APP_KEY environment variable is not set. Please add it in Vercel settings.');
}

try {
    $app = require_once $basePath . '/bootstrap/app.php';

    // Override storage and cache paths for /tmp (read-only filesystem workaround)
    $app->useStoragePath('/tmp/storage');
    $app->useCachePath('/tmp/cache');

    // Create necessary directories
    $dirs = [
        '/tmp/storage/framework/sessions',
        '/tmp/storage/framework/views',
        '/tmp/storage/framework/cache',
        '/tmp/storage/framework/cache/data',
        '/tmp/storage/logs',
        '/tmp/storage/app',
        '/tmp/cache',
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
    
} catch (\Throwable $e) {
    http_response_code(500);
    echo "Laravel Error: " . $e->getMessage() . "\n\n";
    echo "File: " . $e->getFile() . ":" . $e->getLine() . "\n\n";
    
    if (getenv('APP_DEBUG') === 'true') {
        echo "Stack trace:\n" . $e->getTraceAsString();
    } else {
        echo "Set APP_DEBUG=true in Vercel environment variables to see full stack trace.";
    }
}
