<?php

namespace App\Http\Resources;

use App\Models\Budget;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Budget */
class BudgetAggregationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->whenLoaded('aggregation', $this->aggregation?->uuid),
            'budget_cycle' => $this->budget_cycle,
            'data' => $this->whenLoaded('aggregation', $this->aggregation?->data?->reduce(function ($result, $aggregation) {
                $result[$aggregation->type->value] = $aggregation->value;
                return $result;
            }, [])),
        ];
    }
}
