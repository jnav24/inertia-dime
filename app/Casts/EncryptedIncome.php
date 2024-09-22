<?php

namespace App\Casts;

use App\Data\IncomeDto;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Crypt;
use InvalidArgumentException;

class EncryptedIncome implements CastsAttributes
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
            ->map(fn ($item) => new IncomeDto(name: $item['name'], amount: $item['amount'], initial_pay_date: $item['initial_pay_date']));
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

        if (! $value->every(fn ($item) => $item instanceof IncomeDto)) {
            throw new InvalidArgumentException('The given value is not an instance of the IncomeDto');
        }

        return Crypt::encryptString(json_encode($value));
    }
}
