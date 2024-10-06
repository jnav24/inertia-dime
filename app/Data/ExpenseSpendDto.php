<?php

namespace App\Data;

use DateTime;

class ExpenseSpendDto extends BaseExpenseDto
{
    public function __construct(
        string $name,
        float $amount,
        public ?int $due_date = null,
        public ?string $confirmation = null,
        public ?DateTime $paid_date = null,
        public ?string $notes = null,
    )
    {
        parent::__construct($name, $amount);
    }
}
