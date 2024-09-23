<?php

namespace App\Casts;

use App\Data\ExpenseSpendDto;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Crypt;
use InvalidArgumentException;

class EncryptedExpenseSpend implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): ExpenseSpendDto
    {
        $item = json_decode(Crypt::decryptString($value), true);

        return new ExpenseSpendDto(name: $item['name'], amount: $item['amount'], due_date: $item['due_date']);
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): string
    {
        if (! $value instanceof ExpenseSpendDto) {
            throw new InvalidArgumentException('The given value is not an instance of the ExpenseSpendDto');
        }

        return Crypt::encryptString(json_encode($value));
    }
}
