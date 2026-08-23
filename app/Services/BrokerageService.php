<?php

namespace App\Services;

use App\Enums\FrequencyEnum;
use App\Models\Dividend;

class BrokerageService
{
    public readonly array $stocks;
    public readonly array $dividends;

    public function __construct()
    {
        $this->stocks = [
            FmpService::class,
            SeekingAlphaService::class,
        ];

        $this->dividends = [
            MassiveService::class,
            SeekingAlphaService::class,
        ];
    }

    public function getDividendOrCreate(string $ticker): ?Dividend
    {
        $dividend = Dividend::query()->where('symbol', $ticker)->first();

        if (empty($dividend)) {
            foreach ($this->stocks as $key => $class) {
                $dividendResponse = app($this->dividends[$key])->getAndMapDividend($ticker);
                $stockResponse = app($class)->getAndMapStock($ticker);

                if (!empty($stockResponse) && !empty($dividendResponse)) {
                    $data = $this->calculateYield([ ...$stockResponse, ...$dividendResponse ]);
                    $dividend = Dividend::create($data);
                    break;
                }
            }
        }

        return $dividend;
    }

    public function updateDividend(string $ticker): void
    {
        $dividend = Dividend::query()->where('symbol', $ticker)->firstOrFail();

        foreach ($this->stocks as $key => $class) {
            $dividendResponse = app($this->dividends[$key])->getAndMapDividend($ticker);
            $stockResponse = app($class)->getAndMapStock($ticker);

            if (!empty($stockResponse) && !empty($dividendResponse)) {
                $data = $this->calculateYield([ ...$stockResponse, ...$dividendResponse ]);
                $dividend->update($data);
                break;
            }
        }
    }

    private function calculateYield(array $stock): array
    {
        if (!empty($stock['yield'])) {
            return $stock;
        }

        $payoutAmount = ($stock['payout_amount'] ?? 0.00) * ($dividend['frequency'] ?? 4);
        $stock['yield'] = ($payoutAmount / $stock['price']) * 100;
        return $stock;
    }

    /**
     * @deprecated
     * @param array $dividend
     * @param array $stock
     * @return array
     */
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
