<?php

namespace App\Http\Resources;

use App\Models\UserDividendTransaction;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin UserDividendTransaction */
class UserDividendTransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'uuid' => $this->uuid,
            'transaction_type' => $this->transaction_type,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'transaction_date' => $this->transaction_date,
            'user_dividend' => new UserDividendResource($this->whenLoaded('userDividend')),
        ];
    }
}
