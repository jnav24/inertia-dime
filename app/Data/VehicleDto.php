<?php

namespace App\Data;

class VehicleDto
{
    public function __construct(
        public int $amount,
        public int $balance,
        public int $due_date,
        public ?int $mileage = null,
    )
    {}
}
