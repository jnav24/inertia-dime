<?php

namespace App\Providers;

use App\Services\RestoreDataService;
use Illuminate\Support\ServiceProvider;

class RestoreDataProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(RestoreDataService::class, function ($app) {
            return new RestoreDataService();
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
