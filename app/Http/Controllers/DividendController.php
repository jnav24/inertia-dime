<?php

namespace App\Http\Controllers;

use App\Http\Resources\DividendResource;
use App\Http\Resources\UserDividendResource;
use Exception;
use Throwable;
use App\Enums\TransactionEnum;
use App\Models\Dividend;
use App\Models\UserDividendTransaction;
use App\Services\BrokerageService;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Validation\Rule;

class DividendController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Dividend', $this->getResponse());
    }

    public function search(Request $request, BrokerageService $brokerageService)
    {
        $validated = $request->validate([
            'search' => 'required',
        ]);

        $dividend = $brokerageService->getDividendOrCreate($validated['search']);

        return Inertia::render('Dividend', [
            ...$this->getResponse(),
            'results' => DividendResource::collection(collect([$dividend])->flatten()->filter()->values()),
        ]);
    }

    /**
     * @param Request $request
     * @param Dividend $dividend
     * @return Response
     * @throws Throwable
     */
    public function update(Request $request, Dividend $dividend)
    {
        $validated = $request->validate([
            'quantity' => 'required|decimal:0,8|min:0.01',
            'price' => 'required|decimal:2,8|min:0.01',
            'transaction_type' => ['required', Rule::in(array_column(TransactionEnum::cases(), 'value')) ]
        ]);

        $userDividend = auth()->user()
            ->userDividends
            ->where('dividend_id', $dividend->id)
            ->first();

        try {
            DB::beginTransaction();

            if ($userDividend) {
                $userDividend->update([
                    'quantity' => $userDividend->quantity + $validated['quantity'],
                ]);
            } else {
                $userDividend = auth()->user()->userDividends()->create([
                    'quantity' => $validated['quantity'],
                    'dividend_id' => $dividend->id,
                ]);
            }

            UserDividendTransaction::create([
                'quantity' => $validated['quantity'],
                'price' => $validated['price'],
                'transaction_date' => now(),
                'transaction_type' => TransactionEnum::BUY->value,
                'user_dividend_id' => $userDividend->id,
            ]);

            DB::commit();

            return Inertia::render('Dividend', $this->getResponse());
        } catch(Throwable $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }

    private function getResponse(): array
    {
        return [
            'items' => UserDividendResource::collection(
                auth()->user()->userDividends()->with('dividend')->get(),
            ),
            'results' => [ 'data' => [] ],
        ];
    }
}
