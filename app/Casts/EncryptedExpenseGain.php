<?php

namespace App\Casts;

use App\Data\ExpenseGainDto;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
use InvalidArgumentException;

class EncryptedExpenseGain implements CastsAttributes
{
    /**
     * @param Model $model
     * @param string $key
     * @param mixed $value
     * @param array $attributes
     * @return ExpenseGainDto
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): ExpenseGainDto
    {
        $item = json_decode(Crypt::decryptString($value), true);
        return new ExpenseGainDto(name: $item['name'], amount: $item['amount']);
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): string
    {
        if (! $value instanceof ExpenseGainDto) {
            throw new InvalidArgumentException('The given value is not an instance of the ExpenseGainDto');
        }

        return Crypt::encryptString(json_encode($value));
    }
}
