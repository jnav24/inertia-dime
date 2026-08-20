<?php

namespace App\Jobs;

use App\Enums\TransactionEnum;
use App\Models\Dividend;
use App\Models\UserDividend;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ReinvestDividendJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Dividend::query()
            ->with('userDividends.transactions')
            ->where('payout_date', now()->today())
            ->get()
            ->each(function (Dividend $dividend) {
                $dividend
                    ->userDividends
                    ->each(function (UserDividend $userDividend) use ($dividend) {
                        $excludeQuantity = $userDividend
                            ->transactions()
                            ->where('transaction_type', TransactionEnum::BUY->value)
                            ->where('transaction_date', '>=', $dividend->ex_date)
                            ->sum('quantity');

                        $payout = $dividend->payout_amount * max(0, $userDividend->quantity - $excludeQuantity);
                        $newShares = $payout / $dividend->price;

                        $userDividend->transactions()->create([
                            'quantity' => $newShares,
                            'price' => $dividend->price,
                            'transaction_date' => now(),
                            'transaction_type' => TransactionEnum::REINVEST->value,
                        ]);

                        $userDividend->update([
                            'quantity' => $userDividend->quantity + $newShares,
                        ]);
                    });
            });
    }
}
