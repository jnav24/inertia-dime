<?php

namespace App\Casts;

use App\Data\BudgetAggregationDto;
use App\Enums\BudgetAggregationEnum;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Crypt;
use InvalidArgumentException;

class EncryptedBudgetAggregation implements CastsAttributes
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
            ->map(
                fn ($d) => new BudgetAggregationDto(value: $d['value'], type: BudgetAggregationEnum::from($d['type'])),
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
            throw new InvalidArgumentException("The given value must be an instance of Collection.");
        }

        if (! $value->every(fn ($item) => $item instanceof BudgetAggregationDto)) {
            throw new InvalidArgumentException("The given value is not an instance of the BudgetAggregationDto");
        }

        return Crypt::encryptString(json_encode($value));
    }
}
