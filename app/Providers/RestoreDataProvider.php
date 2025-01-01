<?php

namespace App\Providers;

use App\Services\CommonExpenseService;
use App\Services\RestoreDataService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class RestoreDataProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(RestoreDataService::class, function ($app) {
            $commonExpense = new CommonExpenseService();
            $connection = DB::build([
                'driver' => config('database.connections.mysql.driver'),
                'database' => config('database.connections.mysql.backup_database'),
                'host' => config('database.connections.mysql.host'),
                'username' => config('database.connections.mysql.root_username'),
                'password' => config('database.connections.mysql.password'),
            ]);

            return new RestoreDataService($connection, $commonExpense);
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
