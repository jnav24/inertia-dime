<?php

namespace App\Console\Commands;

use App\Services\RestoreDataService;
use Illuminate\Console\Command;

class RestoreDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'restore:data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Restore backup from Dime 2.0 to Dime 3.0';

    /**
     * Execute the console command.
     */
    public function handle(RestoreDataService $restoreDataService): void
    {
        $restoreDataService->restore();
    }
}
