<?php

namespace App\Data;

use DateTime;

class VehicleDto
{
    public function __construct(
        public float $amount,
        public float $balance,
        public int $due_date,
        public ?int $mileage = null,
        public ?string $confirmation = null,
        public ?string $notes = null,
        public ?float $apr,
        public ?float $limit,
        public ?DateTime $paid_date = null,
    )
    {}
}
