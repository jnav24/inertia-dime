<?php

namespace App\Providers;

use App\Services\BrokerageService;
use App\Services\CommonExpenseService;
use App\Services\FmpService;
use App\Services\MassiveService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public $singletons = [
        BrokerageService::class => BrokerageService::class,
        CommonExpenseService::class => CommonExpenseService::class,
        FmpService::class => FmpService::class,
        MassiveService::class => MassiveService::class,
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {}

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
