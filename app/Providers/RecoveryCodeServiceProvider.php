<?php

namespace App\Providers;

use App\Services\RecoveryCodeService;
use Illuminate\Support\ServiceProvider;

class RecoveryCodeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(RecoveryCodeService::class, function ($app) {
            return new RecoveryCodeService();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
