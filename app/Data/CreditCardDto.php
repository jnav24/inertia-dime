<?php

namespace App\Data;

use DateTime;

class CreditCardDto extends ExpenseSpendDto
{
    public function __construct(
        string $name,
        float $amount,
        int $due_date,
        ?string $confirmation = null,
        ?DateTime $paid_date = null,
        ?string $notes = null,
        public ?float $apr = null,
        public ?float $balance = null,
        public ?string $exp_month = null,
        public ?string $exp_year = null,
        public ?string $last_4 = null,
        public ?float $limit = null,
    )
    {
        parent::__construct($name, $amount, $due_date, $confirmation, $paid_date, $notes);
    }
}
