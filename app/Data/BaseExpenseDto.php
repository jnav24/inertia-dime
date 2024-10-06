<?php

namespace App\Data;

class BaseExpenseDto
{
    public function __construct(
        public string $name,
        public float $amount,
    )
    {}
}
