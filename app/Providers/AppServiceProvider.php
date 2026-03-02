<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Configure for serverless environment
        if (isset($_ENV['VERCEL']) || isset($_ENV['LAMBDA_TASK_ROOT'])) {
            $this->app->useStoragePath('/tmp/storage');
            
            // Ensure storage directories exist
            $storagePath = '/tmp/storage';
            $dirs = [
                $storagePath . '/framework/sessions',
                $storagePath . '/framework/views',
                $storagePath . '/framework/cache',
                $storagePath . '/framework/cache/data',
                $storagePath . '/logs',
                $storagePath . '/app',
            ];
            
            foreach ($dirs as $dir) {
                if (!is_dir($dir)) {
                    @mkdir($dir, 0755, true);
                }
            }
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
    }
}
