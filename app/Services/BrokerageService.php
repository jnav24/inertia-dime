<?php

namespace App\Services;

use App\Enums\FrequencyEnum;
use App\Models\Dividend;
use Illuminate\Support\Arr;

class BrokerageService
{
    public function __construct(
        private readonly FmpService $fmpService,
        private readonly MassiveService $massiveService,
    ) {}

    public function getDividendOrCreate(string $ticker): ?Dividend
    {
        $dividend = Dividend::query()->where('symbol', $ticker)->first();

        if (empty($dividend)) {
            $dividendResponse = Arr::first($this->massiveService->getDividend($ticker));
            $stockResponse = Arr::first($this->fmpService->getStock($ticker));

            if (empty($dividendResponse) && empty($stockResponse)) {
                return null;
            }

            $dividend = Dividend::create($this->mapDividend($dividendResponse, $stockResponse));
        }

        return $dividend;
    }

    public function updateDividend(string $ticker)
    {
        $dividend = Dividend::query()->where('symbol', $ticker)->firstOrFail();

        $dividendResponse = Arr::first($this->massiveService->getDividend($ticker));
        $stockResponse = Arr::first($this->fmpService->getStock($ticker));

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
            'average_volume' => $stock['averageVolume'],
            'beta' => $stock['beta'] ?? 1,
            'ceo' => $stock['ceo'],
            'change' => $stock['change'],
            'change_percentage' => $stock['changePercentage'],
            'cik' => $stock['cik'],
            'city' => $stock['city'],
            'company_name' => $stock['companyName'],
            'country' => $stock['country'],
            'cusip' => $stock['cusip'],
            'currency' => $stock['currency'],
            'declaration_date' => $dividend['declaration_date'] ?? null,
            'description' => $stock['description'],
            'distribution_type' => $dividend['distribution_type'],
            'exchange' => $stock['exchange'] ?? null,
            'exchange_full_name' => $stock['exchangeFullName'] ?? null,
            'ex_date' => $dividend['ex_dividend_date'] ?? null,
            'frequency' => FrequencyEnum::fromApiValue($dividend['frequency'] ?? 4),
            'full_time_employees' => $stock['fullTimeEmployees'],
            'market_cap' => $stock['marketCap'] ?? null,
            'image' => $stock['image'],
            'industry' => $stock['industry'],
            'ipo_date' => $stock['ipoDate'] ?? null,
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
            'website' => $stock['website'],
            'yield' => $this->calculateYield($dividend, $stock['price']),
            'zip' => $stock['zip'],
        ];
    }
}
