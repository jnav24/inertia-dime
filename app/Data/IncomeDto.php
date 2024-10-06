<?php

namespace App\Data;

class IncomeDto extends ExpenseGainDto
{
    public function __construct(string $name, float $amount, public \DateTime $initial_pay_date)
    {
        parent::__construct($name, $amount);
    }
}
