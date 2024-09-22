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
    public function get(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        $decoded = json_decode(Crypt::decryptString($value), true);

        return collect($decoded)
            ->map(fn ($item) => new UserVehicleDto(
                color: $item['color'],
                make: $item['make'],
                model: $item['model'],
                year: $item['year'],
                license: $item['license']
            ));
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        if (! ($value instanceof Collection)) {
            throw new InvalidArgumentException('The given value must be an instance of Collection.');
        }

        if (! $value->every(fn ($item) => $item instanceof UserVehicleDto)) {
            throw new InvalidArgumentException('The given value is not an instance of the UserVehicleDto');
        }

        return Crypt::encryptString(json_encode($value));
    }
}
