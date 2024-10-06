<?php

namespace App\Data;

class CreditCardDto extends ExpenseSpendDto
{
    public function __construct(
        string $name,
        float $amount,
        int $due_date,
        public ?float $apr = null,
        public ?float $balance = null,
        public ?int $exp_month = null,
        public ?int $exp_year = null,
        public ?int $last_4 = null,
        public ?float $limit = null,
    )
    {
        parent::__construct($name, $amount, $due_date);
    }
}
