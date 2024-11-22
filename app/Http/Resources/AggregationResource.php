<?php

namespace App\Http\Resources;

use App\Models\BudgetAggregation;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin BudgetAggregation */
class AggregationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->uuid,
            'data' => $this->data,
            'budget' => new BudgetResource($this->whenLoaded('budget')),
        ];
    }
}
