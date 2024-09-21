<?php

namespace App\Data;

class BaseExpenseDto
{
    public function __construct(
        public string $name,
        public int $amount,
    )
    {}
}
