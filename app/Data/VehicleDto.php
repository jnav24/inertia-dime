<?php

namespace App\Data;

class VehicleDto
{
    public function __construct(
        public float $amount,
        public float $balance,
        public int $due_date,
        public ?int $mileage = null,
    )
    {}
}
