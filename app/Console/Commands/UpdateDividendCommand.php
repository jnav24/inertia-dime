<?php

namespace App\Console\Commands;

use App\Models\Dividend;
use App\Services\BrokerageService;
use Illuminate\Console\Command;

class UpdateDividendCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dividends:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update dividends in the database';

    public function __construct(private readonly BrokerageService $brokerageService)
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        Dividend::query()
            ->whereDate('updated_at', '!=', now()->today())
            ->take(5)
            ->get()
            ->each(function (Dividend $dividend) {
                $this->brokerageService->updateDividend($dividend->symbol);
                $this->info("Updated {$dividend->symbol}");
            });

        $this->info("Dividends were updated successfully");
        return self::SUCCESS;
    }
}
