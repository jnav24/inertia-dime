<?php

namespace App\Casts;

use App\Data\LoanDto;
use Carbon\Carbon;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
use InvalidArgumentException;

class EncryptedLoan implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): LoanDto
    {
        $item = json_decode(Crypt::decryptString($value), true);

        return new LoanDto(
            name: $item['name'],
            amount: $item['amount'],
            due_date: $item['due_date'],
            apr: $item['apr'],
            balance: $item['balance'],
            limit: $item['limit'],
            confirmation: $item['confirmation'],
            notes: $item['notes'],
            paid_date: Carbon::parse($item['paid_date']),
        );
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): string
    {
        if (! $value instanceof LoanDto) {
            throw new InvalidArgumentException('The given value is not an instance of the LoanDto');
        }

        return Crypt::encryptString(json_encode($value));
    }
}
