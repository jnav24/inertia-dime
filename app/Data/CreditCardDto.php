<?php

namespace App\Data;

class CreditCardDto extends ExpenseSpendDto
{
    public function __construct(
        string $name,
        int $amount,
        int $due_date,
        public ?int $apr = null,
        public ?int $balance = null,
        public ?int $exp_month = null,
        public ?int $exp_year = null,
        public ?int $last_4 = null,
        public ?int $limit = null,
    )
    {
        parent::__construct($name, $amount, $due_date);
    }
}
