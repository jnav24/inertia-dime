<?php

namespace App\Data;

use App\Enums\BudgetAggregationEnum;

class BudgetAggregationDto
{
    public function __construct(
        public float|int $value,
        public BudgetAggregationEnum $type,
    ) {}
}
