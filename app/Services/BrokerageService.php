<?php

namespace App\Services;

use App\Enums\FrequencyEnum;
use App\Models\Dividend;
use Illuminate\Support\Arr;

class BrokerageService
{
    public function getDividendOrCreate(FmpService $fmpService, MassiveService $massiveService, string $ticker): ?Dividend
    {
        $dividend = Dividend::query()->where('symbol', $ticker)->first();

        if (empty($dividend)) {
            $dividendResponse = Arr::first($massiveService->getDividend($ticker));
            $stockResponse = Arr::first($fmpService->getStock($ticker));

            if (empty($dividendResponse) && empty($stockResponse)) {
                return null;
            }

            $dividend = Dividend::create($this->mapDividend($dividendResponse, $stockResponse));
        }

        return $dividend;
    }

    public function updateDividend(FmpService $fmpService, MassiveService $massiveService, string $ticker)
    {
        $dividend = Dividend::query()->where('symbol', $ticker)->firstOrFail();

        $dividendResponse = Arr::first($massiveService->getDividend($ticker));
        $stockResponse = Arr::first($fmpService->getStock($ticker));

        if (empty($dividendResponse) && empty($stockResponse)) {
            return null;
        }

        $dividend->update($this->mapDividend($dividendResponse, $stockResponse));
    }

    private function calculateYield(array $dividend, float $price): float
    {
        $payoutAmount = ($dividend['cash_amount'] ?? 0.00) * ($dividend['frequency'] ?? 4);
        return ($payoutAmount / $price) * 100;
    }

    private function mapDividend(array $dividend, array $stock): array
    {
        return [
            'address' => $stock['address'],
            'average_volume' => $stock['average_volume'],
            'beta' => $stock['beta'] ?? 1,
            'ceo' => $stock['ceo'],
            'change' => $stock['change'],
            'change_percentage' => $stock['change_percentage'],
            'cik' => $stock['cik'],
            'city' => $stock['city'],
            'country' => $stock['country'],
            'cusip' => $stock['cusip'],
            'declaration_date' => $dividend['declaration_date'] ?? null,
            'description' => $stock['description'],
            'exchange' => $stock['exchange'] ?? null,
            'exchange_full_name' => $stock['exchangeFullName'] ?? null,
            'ex_date' => $dividend['ex_dividend_date'] ?? null,
            'frequency' => FrequencyEnum::fromApiValue($dividend['frequency'] ?? 4),
            'full_time_employees' => $stock['fullTimeEmployees'],
            'market_cap' => $stock['market_cap'] ?? null,
            'name' => $stock['name'],
            'image' => $stock['image'],
            'industry' => $stock['industry'],
            'ipo_date' => $stock['ipo_date'] ?? null,
            'isin' => $stock['isin'],
            'is_actively_trading' => $stock['isActivelyTrading'],
            'is_adr' => $stock['isAdr'],
            'is_etf' => $stock['isEtf'],
            'is_fund' => $stock['isFund'],
            'payout_amount' => $dividend['cash_amount'] ?? 0.00,
            'payout_date' => $dividend['pay_date'] ?? null,
            'phone' => $stock['phone'],
            'price' => $stock['price'],
            'range' => $stock['range'],
            'record_date' => $dividend['record_date'] ?? null,
            'sector' => $stock['sector'],
            'source' => 'custom',
            'state' => $stock['state'],
            'symbol' => $stock['symbol'],
            'volume' => $stock['volume'],
            'yield' => $this->calculateYield($dividend, $stock['price']),
            'zip' => $stock['zip'],
        ];
    }
}
