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

        dd($response->json());

        return [];
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

        dd($response->json());

        return [];
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
}
