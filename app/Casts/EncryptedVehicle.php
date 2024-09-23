<?php

namespace App\Casts;

use App\Data\VehicleDto;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Crypt;
use InvalidArgumentException;

class EncryptedVehicle implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): VehicleDto
    {
        $item = json_decode(Crypt::decryptString($value), true);

        return new VehicleDto(
            amount: $item['amount'],
            balance: $item['balance'],
            due_date: $item['due_date'],
            mileage: $item['mileage']
        );
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): string
    {
        if (! $value instanceof VehicleDto) {
            throw new InvalidArgumentException('The given value is not an instance of the VehicleDto');
        }

        return Crypt::encryptString(json_encode($value));
    }
}
