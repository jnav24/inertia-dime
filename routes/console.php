<?php

use App\Jobs\ReinvestDividendJob;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::command('dividends:update')->everyFifteenMinutes();
Schedule::job(ReinvestDividendJob::class)->dailyAt('09:00');
