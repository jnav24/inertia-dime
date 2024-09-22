<?php

namespace App\Data;

class UserVehicleDto
{
    public function __construct(
        public string $color,
        public string $make,
        public string $model,
        public int $year,
        public ?string $license = null,
    )
    {}
}
