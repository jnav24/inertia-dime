<?php

namespace App\Data;

class ExpenseSpendDto extends BaseExpenseDto
{
    public function __construct(string $name, int $amount, public int $due_date)
    {
        parent::__construct($name, $amount);
    }
}
