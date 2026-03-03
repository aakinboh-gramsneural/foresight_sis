<?php

// Vercel serverless entry point for Laravel

// Set memory limit
ini_set('memory_limit', '512M');

// Define base path
define('LARAVEL_START', microtime(true));

// Determine the correct base path for Vercel
// On Vercel, files are in /var/task/user/
$basePath = dirname(__DIR__);

// Check multiple possible locations
$possiblePaths = [
    '/var/task/user',
    $_ENV['LAMBDA_TASK_ROOT'] ?? null,
    $basePath
];

foreach ($possiblePaths as $path) {
    if ($path && file_exists($path . '/vendor/autoload.php')) {
        $basePath = $path;
        break;
    }
}

// Set cache paths to /tmp before Laravel boots
putenv('APP_SERVICES_CACHE=/tmp/cache/services.php');
putenv('APP_PACKAGES_CACHE=/tmp/cache/packages.php');
putenv('APP_CONFIG_CACHE=/tmp/cache/config.php');
putenv('APP_ROUTES_CACHE=/tmp/cache/routes.php');
putenv('APP_EVENTS_CACHE=/tmp/cache/events.php');

$_ENV['APP_SERVICES_CACHE'] = '/tmp/cache/services.php';
$_ENV['APP_PACKAGES_CACHE'] = '/tmp/cache/packages.php';
$_ENV['APP_CONFIG_CACHE'] = '/tmp/cache/config.php';
$_ENV['APP_ROUTES_CACHE'] = '/tmp/cache/routes.php';
$_ENV['APP_EVENTS_CACHE'] = '/tmp/cache/events.php';

// Verify vendor exists
if (!file_exists($basePath . '/vendor/autoload.php')) {
    http_response_code(500);
    echo "Error: Composer autoload not found.\n";
    echo "Checked paths:\n";
    foreach ($possiblePaths as $path) {
        if ($path) {
            echo "- $path/vendor/autoload.php: " . (file_exists($path . '/vendor/autoload.php') ? 'EXISTS' : 'NOT FOUND') . "\n";
        }
    }
    echo "\nCurrent working directory: " . getcwd() . "\n";
    echo "Files in /var/task/: " . (is_dir('/var/task/') ? implode(', ', scandir('/var/task/')) : 'NOT A DIRECTORY') . "\n";
    if (is_dir('/var/task/user/')) {
        echo "Files in /var/task/user/: " . implode(', ', array_slice(scandir('/var/task/user/'), 0, 20)) . "\n";
    }
    die();
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

    // Override storage path for /tmp (read-only filesystem workaround)
    $app->useStoragePath('/tmp/storage');

    // Create necessary directories
    $dirs = [
        '/tmp/storage/framework/sessions',
        '/tmp/storage/framework/views',
        '/tmp/storage/framework/cache',
        '/tmp/storage/framework/cache/data',
        '/tmp/storage/logs',
        '/tmp/storage/app',
        '/tmp/cache',
        '/tmp/database',
    ];

    foreach ($dirs as $dir) {
        if (!is_dir($dir)) {
            @mkdir($dir, 0755, true);
        }
    }

    // Handle SQLite database for serverless
    $dbPath = '/tmp/database/database.sqlite';
    if (!file_exists($dbPath)) {
        // Create empty database file
        touch($dbPath);
        chmod($dbPath, 0666);
        
        // Set database path in environment
        putenv("DB_DATABASE=$dbPath");
        $_ENV['DB_DATABASE'] = $dbPath;
        
        // Run migrations to create tables
        $artisan = require $basePath . '/bootstrap/app.php';
        $kernel = $artisan->make(Illuminate\Contracts\Console\Kernel::class);
        $kernel->call('migrate', ['--force' => true, '--seed' => true]);
    } else {
        // Database exists, just set the path
        putenv("DB_DATABASE=$dbPath");
        $_ENV['DB_DATABASE'] = $dbPath;
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
    
    // Always show detailed errors for debugging
    echo "<!DOCTYPE html><html><head><title>Error</title></head><body>";
    echo "<h1>Laravel Error</h1>";
    echo "<p><strong>Message:</strong> " . htmlspecialchars($e->getMessage()) . "</p>";
    echo "<p><strong>File:</strong> " . htmlspecialchars($e->getFile()) . ":" . $e->getLine() . "</p>";
    echo "<h2>Stack Trace:</h2>";
    echo "<pre>" . htmlspecialchars($e->getTraceAsString()) . "</pre>";
    echo "<h2>Environment Info:</h2>";
    echo "<pre>";
    echo "Base Path: " . htmlspecialchars($basePath) . "\n";
    echo "Vendor exists: " . (file_exists($basePath . '/vendor/autoload.php') ? 'YES' : 'NO') . "\n";
    echo "Bootstrap exists: " . (file_exists($basePath . '/bootstrap/app.php') ? 'YES' : 'NO') . "\n";
    echo "APP_KEY set: " . (getenv('APP_KEY') ? 'YES' : 'NO') . "\n";
    echo "VERCEL env: " . (isset($_ENV['VERCEL']) ? 'YES' : 'NO') . "\n";
    echo "</pre>";
    echo "</body></html>";
}
