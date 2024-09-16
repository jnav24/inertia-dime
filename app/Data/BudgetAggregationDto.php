<?php

namespace App\Data;

use App\Enums\BudgetAggregationEnum;

class BudgetAggregationDto
{
    public function __construct(
        public int $value,
        public BudgetAggregationEnum $type,
    ) {}
}
