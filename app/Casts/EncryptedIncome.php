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
        $item = json_decode(Crypt::decryptString($value), true);

        return new IncomeDto(name: $item['name'], amount: $item['amount'], initial_pay_date: $item['initial_pay_date']);
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): string
    {
        if (! $value instanceof IncomeDto) {
            throw new InvalidArgumentException('The given value is not an instance of the IncomeDto');
        }

        return Crypt::encryptString(json_encode($value));
    }
}
