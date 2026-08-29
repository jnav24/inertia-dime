<?php

namespace App\Services;

use App\Enums\FrequencyEnum;
use App\Models\Dividend;
use App\Contracts\BrokerageInterface;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MassiveService implements BrokerageInterface
{
    public function getDividend(string $ticker): array
    {
        $response = Http::get(config('services.massive.api_url') . '/stocks/v1/dividends', [
            'ticker' => $ticker,
            'limit' => 1,
            'sort' => 'ex_dividend_date.desc',
            'apikey' => config('services.massive.api_key'),
        ]);

        if ($response->failed()) {
            Log::error($response->json()['error'] ?? $response->body());
            return [];
        }

        return $response->json()['results'];
    }

    public function getStock(string $ticker): array
    {
        $response = Http::get(config('services.massive.api_url') . '/v3/reference/tickers/' . $ticker, [
            'apiKey' => config('services.massive.api_key'),
        ]);

        if ($response->failed()) {
            Log::error($response->json()['error'] ?? $response->body());
            return [];
        }

        return [];
    }

    public function getStockPrice(string $ticker)
    {
        $response = Http::get(config('services.massive.api_url') . '/v2/aggs/ticker/' . $ticker . '/prev', [
            'apiKey' => config('services.massive.api_key'),
        ]);

        if ($response->failed()) {
            Log::error($response->json()['error'] ?? $response->body());
            return [];
        }

        return [];
    }

    public function getDividendOrCreate(string $ticker): ?Dividend
    {
        $dividend = Dividend::query()->where('symbol', $ticker)->first();

        if (empty($dividend)) {
            $dividendResponse = Arr::first($this->getDividend($ticker));
            $stockResponse = Arr::first($this->getStock($ticker));
            $priceResponse = Arr::first($this->getStockPrice($ticker));

            if (empty($dividendResponse) && empty($stockResponse)) {
                return null;
            }

            $dividend = Dividend::create([
                'declaration_date' => $dividendResponse['declaration_date'] ?? null,
                'ex_date' => $dividendResponse['ex_dividend_date'] ?? null,
                'frequency' => FrequencyEnum::fromApiValue($dividendResponse['frequency'] ?? 4)->value,
                'name' => $stockResponse['name'],
                'image' => $stockResponse['branding']['logo_url'],
                'industry' => $stockResponse['industry'], // no industry in massive api
                'payout_amount' => $dividendResponse['cash_amount'] ?? 0.00,
                'payout_date' => $dividendResponse['pay_date'] ?? null,
                'price' => $priceResponse['c'] ?? 0.00,
                'record_date' => $dividendResponse['record_date'] ?? null,
                'sector' => $stockResponse['sector'], // no sector in massive api
                'source' => 'massive',
                'symbol' => $stockResponse['ticker'],
                'yield' => $dividendResponse['yield'] ?? 0.00, // no yield in massive api
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
        $stock = Arr::first($this->getStock($symbol));
        return $this->mapStock($stock);
    }

    private function mapDividend(array $stock)
    {
        if (empty($stock)) {
            return [];
        }

        return [
            'declaration_date' => $stock['declaration_date'] ?? null,
            'distribution_type' => $stock['distribution_type'] ?? 'recurring',
            'ex_date' => $stock['ex_dividend_date'] ?? null,
            'frequency' => FrequencyEnum::fromApiValue($stock['frequency'] ?? 4)->value,
            'payout_amount' => $stock['cash_amount'] ?? 0.00,
            'payout_date' => $stock['pay_date'] ?? null,
            'record_date' => $stock['record_date'] ?? null,
        ];
    }

    private function mapStock(array $stock)
    {
        // these are missing from the massive api
        // 'average_volume' => $stock['averageVolume'],
        // 'beta' => $stock['beta'] ?? 1,
        // 'ceo' => $stock['ceo'],
        // 'change' => $stock['change'],
        // 'change_percentage' => $stock['changePercentage'],
        // 'cusip' => $stock['cusip'],
        // 'industry' => $stock['industry'],
        // 'ipo_date' => $stock['ipoDate'] ?? null,
        // 'isin' => $stock['isin'],
        // 'is_actively_trading' => $stock['isActivelyTrading'],
        // 'is_adr' => $stock['isAdr'],
        // 'is_etf' => $stock['isEtf'],
        // 'is_fund' => $stock['isFund'],
        // 'price' => $stock['price'],
        // 'range' => $stock['range'],
        // 'sector' => $stock['sector'],
        // 'volume' => $stock['volume'],
        // 'yield' => $this->calculateYield($dividend, $stock['price']),
        return [
            'address' => $stock['address']['address1'],
            'cik' => $stock['cik'],
            'city' => $stock['address']['city'],
            'company_name' => $stock['name'],
            'country' => $stock['locale'],
            'currency' => $stock['currency_name'],
            'description' => $stock['description'],
            'exchange' => $stock['primary_exchange'] ?? null,
            'exchange_full_name' => $stock['primary_exchange'] ?? null,
            'full_time_employees' => $stock['total_employees'],
            'image' => $stock['branding']['logo_url'],
            'market_cap' => $stock['market_cap'] ?? null,
            'phone' => $stock['phone_number'],
            'source' => 'massive',
            'state' => $stock['address']['state'],
            'symbol' => $stock['ticker'],
            'website' => $stock['homepage_url'],
            'zip' => $stock['address']['postal'],
        ];
    }
}
