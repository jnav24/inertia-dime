<?php

namespace App\Providers;

use App\Services\MfaService;
use Illuminate\Support\ServiceProvider;
use PragmaRX\Google2FA\Google2FA;

class MfaServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(MfaService::class, function ($app) {
            return new MfaService(new Google2FA());
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
