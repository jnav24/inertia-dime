<?php

namespace App\Casts;

use App\Data\UserVehicleDto;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Crypt;
use InvalidArgumentException;

class EncryptedUserVehicle implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): UserVehicleDto
    {
        $item = json_decode(Crypt::decryptString($value), true);

        return new UserVehicleDto(
            color: $item['color'],
            make: $item['make'],
            model: $item['model'],
            year: $item['year'],
            license: $item['license']
        );
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): string
    {
        if (! $value instanceof UserVehicleDto) {
            throw new InvalidArgumentException('The given value is not an instance of the UserVehicleDto');
        }

        return Crypt::encryptString(json_encode($value));
    }
}
