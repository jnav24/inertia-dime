<?php

namespace App\Http\Resources;

use App\Models\Budget;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Budget */
class BudgetResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->uuid,
            'name' => $this->name,
            'budget_cycle' => $this->budget_cycle,
            'aggregation' => new BudgetAggregationResource($this->whenLoaded('aggregation')),
        ];
    }
}
