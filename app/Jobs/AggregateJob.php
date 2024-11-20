<?php

namespace App\Jobs;

use App\Models\Budget;
use App\Models\User;
use App\Services\CommonExpenseService;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class AggregateJob implements ShouldQueue, ShouldBeUnique
{
    use Queueable;

    protected CommonExpenseService $service;

    /**
     * Create a new job instance.
     */
    public function __construct(public string $uuid, public User $user)
    {
        $this->service = app(CommonExpenseService::class);
    }

    public function uniqueId(): string
    {
        return md5("{$this->user->id}|{$this->uuid}");
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $budget = Budget::query()
            ->withExpenses()
            ->where('uuid', $this->uuid)
            ->where('user_id', $this->user->id)
            ->first();

        if (! empty($budget)) {
            $this->service->saveAggregations($budget);
        }
    }
}
