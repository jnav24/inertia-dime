<?php

namespace App\Jobs;

use App\Models\Budget;
use App\Services\CommonExpenseService;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class AggregateJob implements ShouldQueue, ShouldBeUnique
{
    use Queueable;

    protected CommonExpenseService $service;

    /**
     * Create a new job instance.
     */
    public function __construct(public string $uuid)
    {
        $this->service = app(CommonExpenseService::class);
    }

    public function uniqueId(): string
    {
        return $this->uuid;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $budget = Budget::query()
            ->withExpenses()
            ->where('uuid', $this->uuid)
            ->first();

        if (! empty($budget)) {
            Log::debug("Budget: ");
        }
    }
}
