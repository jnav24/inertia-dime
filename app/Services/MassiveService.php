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

        dd($response->json());

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
                'frequency' => FrequencyEnum::fromApiValue($dividendResponse['frequency'] ?? 4),
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
}
