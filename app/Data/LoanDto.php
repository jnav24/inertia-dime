<?php

namespace App\Data;

use DateTime;

class LoanDto extends ExpenseSpendDto
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
        public ?float $limit = null,
    )
    {
        parent::__construct($name, $amount, $due_date, $confirmation, $paid_date, $notes);
    }
}
