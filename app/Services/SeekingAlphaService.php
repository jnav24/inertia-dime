<?php

namespace App\Services;

use App\Contracts\BrokerageInterface;
use App\Enums\FrequencyEnum;
use App\Models\Dividend;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SeekingAlphaService implements BrokerageInterface
{
    // https://seekingalpha.com/api/v3/symbol_data?slugs=AAPL&fields[]=companyName&fields[]=divDistribution&fields[]=dividends&fields[]=divRate&fields[]=divYield&fields[]=longDesc&fields[]=marketCap&fields[]=numberOfEmployees&fields[]=payoutRatio&fields[]=sectorname&fields[]=totalEnterprise&fields[]=yearfounded
    public function getDividend(string $symbol): array
    {
        $params = [
            'slugs' => $symbol,
            'fields' => [
                'companyName',
                'divDistribution',
                'dividends',
                'divRate',
                'divYield',
                'longDesc',
                'marketCap',
                'numberOfEmployees',
                'payoutRatio',
                'sectorname',
                'totalEnterprise',
                'yearfounded',
            ]
        ];

        $query = preg_replace('/\[\d+\]/', '[]', urldecode(http_build_query($params)));

        $response = Http::withHeaders([
            'Content-Type' => 'application/json'
        ])->get(config('services.seeking_alpha.web_url') . "api/v3/symbol_data?{$query}");
        $data = $response->json()['data'] ?? null;

        if (empty($data)) {
            Log::error($response->json()['Error Message'] ?? $response->body());
            return [];
        }

        return $data[0];
    }

    public function getStock(string $symbol): array
    {
        // https://seekingalpha.com/api/v3/symbols/AMZN?lang=en
        // ID is needed for real_time_quotes
        // $response['data']['id']

        // basic info
        // $response['data']['attributes']

        // address info
        // $response['included'].map(fn ($item) => $item['type'] === 'companyInfo')['attributes']

        // image
        // $response['data']['meta']['companyLogoUrlLight']

        $response = Http::withHeaders([
            'Content-Type' => 'application/json'
        ])->get(config('services.seeking_alpha.web_url') . "api/v3/symbols/{$symbol}");

        $data = $response->json()['data'] ?? null;

        if (empty($data)) {
            Log::error($response->json()['Error Message'] ?? $response->body());
            return [];
        }

        // https://seekingalpha.com/symbol/AAPL/dividends/upcoming_dividends (doesn't work)
        // https://seekingalpha.com/api/common/ac/search?limit=5&symbols=1&term=AAPL
        // https://seekingalpha.com/

        return [
            ...$data['attributes'],
            ...$data['meta'],
            ...$response['included'].map(fn ($item) => $item['type'] === 'companyInfo')['attributes'],
            ...$this->getPriceInfo($data['id']),
        ];
    }

    public function getDividendOrCreate(string $symbol): ?Dividend
    {
        $dividend = Dividend::query()->where('symbol', $symbol)->first();

        if (empty($dividend)) {
            $dividend = $this->getDividend($symbol);
            $stock = $this->getStock($symbol);
        }

        return $dividend;
    }

    public function getAndMapDividend(string $symbol): array
    {
        $dividend = $this->getDividend($symbol);
        return $this->mapDividend($dividend);
    }

    public function getAndMapStock(string $symbol): array
    {
        $stock = $this->getStock($symbol);
        return [ ...$this->mapStock($stock), ...$this->mapMissingData($stock) ];
    }

    /**
     * Get real-time price information for a stock from Seeking Alpha API.
     *
     * @return array{
     *     ticker_id: int,
     *     sa_id: int,
     *     sa_slug: string,
     *     symbol: string,
     *     high: float,
     *     low: float,
     *     open: float,
     *     close: float,
     *     prev_close: float,
     *     last: float,
     *     volume: float,
     *     last_time: string,
     *     ext_time: string,
     *     ext_price: float,
     *     ext_market: string,
     *     info: string,
     *     src: string,
     *     updated_at: string
     * }
     */
    private function getPriceInfo(string $id): array
    {
        // https://finance-api.seekingalpha.com/real_time_quotes?sa_ids=562
        // $response['real_time_quotes'][0]
        // {
        //      "ticker_id": 146,
        //      "sa_id": 146,
        //      "sa_slug": "aapl",
        //      "symbol": "AAPL",
        //      "high": 312.38,
        //      "low": 307.01,
        //      "open": 312.05,
        //      "close": 309.35,
        //      "prev_close": 311.3,
        //      "last": 309.35,
        //      "volume": 46876815.909428,
        //      "last_time": "2026-08-21T16:00:00.000-04:00",
        //      "ext_time": "2026-08-21T19:59:59.000-04:00",
        //      "ext_price": 309.69,
        //      "ext_market": "post",
        //      "info": "Market Close",
        //      "src": "XigniteQuotePuller",
        //      "updated_at": "2026-08-21T21:26:20.162-04:00"
        // }

        // Change = Close − Previous Close = 309.35 − 311.30 = −$1.95
        // Change % = (Change ÷ Previous Close) × 100 = (−1.95 ÷ 311.30) × 100 = −0.63%

        $response = Http::withHeaders([
            'Content-Type' => 'application/json'
        ])->get(config('services.seeking_alpha.api_url') . "real_time_quotes?sa_ids={$id}");

        $data = $response->json()['real_time_quotes'] ?? null;

        if (empty($data)) {
            Log::error($response->json()['Error Message'] ?? $response->body());
            return [];
        }

        $change = $data[0]['close'] - $data[0]['prev_close'];

        return [
            ...$data[0],
            'change' => $change,
            'change_percentage' => ($change / $data[0]['prev_close']) * 100
        ];
    }

    private function mapDividend(array $dividend): array
    {
        if (empty($dividend)) {
            return [];
        }

        return [
            'declaration_date' => $dividend['dividends'][0]['declareDate'] ?? null,
            'ex_date' => $dividend['dividends'][0]['exDate'] ?? null,
            'frequency' => FrequencyEnum::fromApiValue($dividend['divDistribution'] ?? 4),
            'market_cap' => $dividend['marketCap'] ?? null,
            'payout_amount' => $dividend['dividends'][0]['amount'] ?? 0.00,
            'payout_date' => $dividend['dividends'][0]['payDate'] ?? null,
            'record_date' => $dividend['dividends'][0]['recordDate'] ?? null,
            'yield' => $dividend['divYield'] ?? 0,
        ];
    }

    private function mapStock(array $stock)
    {
        if (empty($stock)) {
            return [];
        }

        return [
            'address' => $stock['streetaddress'],
            'city' => $stock['city'],
            'company_name' => $stock['companyName'],
            'country' => $stock['country'],
            'currency' => $stock['currency'],
            'description' => $stock['businessDescription'],
            'exchange' => $stock['exchange'] ?? null,
            'exchange_full_name' => $stock['exchangeTitle'] ?? null,
            'full_time_employees' => $stock['numberOfEmployees'],
            'image' => $stock['companyLogoUrlLight'],
            'industry' => $stock['industryDisplay'],
            'is_actively_trading' => $stock['isActivelyTrading'] ?? true,
            'is_adr' => $stock['isAdr'] ?? false,
            'is_etf' => $stock['fundType'] === 'ETF',
            'is_fund' => $stock['fundType'] === 'MF',
            'phone' => $stock['officephonevalue'],
            'price' => $stock['last'],
            'sector' => $stock['sectorDisplay'],
            'source' => 'seeking_alpha',
            'state' => $stock['state'],
            'symbol' => $stock['name'],
            'volume' => $stock['volume'],
            'website' => $stock['webpage'],
            'zip' => $stock['zipcode'],
        ];
    }

    private function mapMissingData(array $stock): array
    {
        return [
            'average_volume' => $stock['averageVolume'] ?? null,
            'beta' => $stock['beta'] ?? 0.00,
            'ceo' => $stock['ceo'] ?? "",
            'cik' => $stock['cik'] ?? null,
            'cusip' => $stock['cusip'] ?? null,
            'distribution_type' => $stock['distribution_type'] ?? "recurring",
            'ipo_date' => $stock['ipoDate'] ?? null,
            'isin' => $stock['isin'] ?? null,
            'range' => $stock['range'] ?? null,
        ];
    }
}

