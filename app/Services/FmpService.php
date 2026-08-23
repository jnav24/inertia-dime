<?php

namespace App\Services;

use App\Enums\FrequencyEnum;
use App\Models\Dividend;
use Illuminate\Support\Arr;
use App\Contracts\BrokerageInterface;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FmpService implements BrokerageInterface
{
    public function getStock(string $ticker): array
    {
        $response = Http::get(config('services.fmp.api_url') . '/stable/profile', [
            'symbol' => $ticker,
            'apikey' => config('services.fmp.api_key'),
        ]);

        if ($response->failed()) {
            Log::error($response->json()['Error Message'] ?? $response->body());
            return [];
        }

        return $response->json();
    }

    public function getDividend(string $ticker): array
    {
        $response = Http::get(config('services.fmp.api_url') . '/stable/dividends', [
            'symbol' => $ticker,
            'apikey' => config('services.fmp.api_key'),
            'limit' => 1,
        ]);

        if ($response->failed()) {
            Log::error($response->json()['Error Message'] ?? $response->body());
            return [];
        }

        return $response->json();
    }

    public function getDividendOrCreate(string $ticker): ?Dividend
    {
        $dividend = Dividend::query()->where('symbol', $ticker)->first();

        if (empty($dividend)) {
            $dividendResponse = Arr::first($this->getDividend($ticker));
            $stockResponse = Arr::first($this->getStock($ticker));

            if (empty($dividendResponse) && empty($stockResponse)) {
                return null;
            }

            $dividend = Dividend::create([
                'declaration_date' => $dividendResponse['declaration_date'] ?? null,
                'ex_date' => $dividendResponse['ex_date'] ?? null,
                'frequency' => FrequencyEnum::fromApiValue($dividendResponse['frequency'] ?? 4),
                'name' => $stockResponse['name'],
                'image' => $stockResponse['image'],
                'industry' => $stockResponse['industry'],
                'payout_amount' => $dividendResponse['payout_amount'] ?? 0.00,
                'payout_date' => $dividendResponse['payout_date'] ?? null,
                'price' => $stockResponse['price'],
                'record_date' => $dividendResponse['record_date'] ?? null,
                'sector' => $stockResponse['sector'],
                'source' => 'fmp',
                'symbol' => $stockResponse['symbol'],
                'yield' => $dividendResponse['yield'] ?? 0.00,
            ]);
        }

        return $dividend;
    }

    public function getAndMapDividend(string $symbol): array
    {
        $dividend = Arr::first($this->getDividend($symbol)) ?? [];
        return $this->mapDividend($dividend);
    }

    public function getAndMapStock(string $symbol): array
    {
        $stock = Arr::first($this->getStock($symbol)) ?? [];
        return $this->mapStock($stock);
    }

    private function mapDividend(array $stock)
    {
        if (empty($stock)) {
            return [];
        }

        return [
            'declaration_date' => $stock['declarationDate'] ?? null,
            'distribution_type' => $stock['distributionType'] ?? 'recurring',
            'ex_date' => $stock['date'] ?? null,
            'frequency' => FrequencyEnum::fromApiValue($stock['frequency'] ?? 4),
            'payout_amount' => $stock['dividend'] ?? 0.00,
            'payout_date' => $stock['payDate'] ?? null,
            'record_date' => $stock['recordDate'] ?? null,
            'yield' => $stock['yield'] ?? 0.00,
        ];
    }

    private function mapStock(array $stock): array
    {
        if (empty($stock)) {
            return [];
        }

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
            'currency' => $stock['currency'],
            'cusip' => $stock['cusip'],
            'description' => $stock['description'],
            'exchange' => $stock['exchange'] ?? null,
            'exchange_full_name' => $stock['exchangeFullName'] ?? null,
            'full_time_employees' => $stock['fullTimeEmployees'],
            'image' => $stock['image'],
            'industry' => $stock['industry'],
            'ipo_date' => $stock['ipoDate'] ?? null,
            'is_actively_trading' => $stock['isActivelyTrading'],
            'is_adr' => $stock['isAdr'],
            'is_etf' => $stock['isEtf'],
            'is_fund' => $stock['isFund'],
            'isin' => $stock['isin'],
            'market_cap' => $stock['marketCap'] ?? null,
            'phone' => $stock['phone'],
            'price' => $stock['price'],
            'range' => $stock['range'],
            'sector' => $stock['sector'],
            'source' => 'fmp',
            'state' => $stock['state'],
            'symbol' => $stock['symbol'],
            'volume' => $stock['volume'],
            'website' => $stock['website'],
            'zip' => $stock['zip'],
        ];
    }
}
