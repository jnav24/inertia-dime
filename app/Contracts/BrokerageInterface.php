<?php

namespace App\Contracts;

use App\Models\Dividend;

interface BrokerageInterface
{
    public function getDividend(string $ticker): array;
    public function getStock(string $ticker): array;
    public function getDividendOrCreate(string $ticker): ?Dividend;
}

