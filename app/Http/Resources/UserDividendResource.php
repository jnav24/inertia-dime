<?php

namespace App\Http\Resources;

use App\Models\UserDividend;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin UserDividend */
class UserDividendResource extends JsonResource
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
            'quantity' => $this->quantity,
            'dividend' => new DividendResource($this->whenLoaded('dividend')),
        ];
    }
}
