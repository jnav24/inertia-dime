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
    public function get(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        $decoded = json_decode(Crypt::decryptString($value), true);

        return collect($decoded)
            ->map(fn ($item) => new CreditCardDto(
                name: $item['name'],
                amount: $item['amount'],
                due_date: $item['due_date'],
                apr: $item['apr'],
                balance: $item['balance'],
                exp_month: $item['exp_month'],
                exp_year: $item['exp_year'],
                last_4: $item['last_4'],
                limit: $item['limit'],
            )
        );
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

        if (! $value->every(fn ($item) => $item instanceof CreditCardDto)) {
            throw new InvalidArgumentException('The given value is not an instance of the CreditCardDto');
        }

        return Crypt::encryptString(json_encode($value));
    }
}
