<?php

namespace App\Casts;

use App\Data\CreditCardDto;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Crypt;
use InvalidArgumentException;

class EncryptedCreditCard implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): CreditCardDto
    {
        $item = json_decode(Crypt::decryptString($value), true);

        return new CreditCardDto(
            name: $item['name'],
            amount: $item['amount'],
            due_date: $item['due_date'],
            apr: $item['apr'],
            balance: $item['balance'],
            exp_month: $item['exp_month'],
            exp_year: $item['exp_year'],
            last_4: $item['last_4'],
            limit: $item['limit'],
        );
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): string
    {
        if (! $value instanceof CreditCardDto) {
            throw new InvalidArgumentException('The given value is not an instance of the CreditCardDto');
        }

        return Crypt::encryptString(json_encode($value));
    }
}
