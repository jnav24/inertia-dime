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
            'expenses' => [
                'banks' => TemplateResource::collection($this->whenLoaded('banks')),
                'childcares' => TemplateResource::collection($this->whenLoaded('childcares')),
                'creditCards' => TemplateResource::collection($this->whenLoaded('creditCards')),
                'education' => TemplateResource::collection($this->whenLoaded('education')),
                'entertainments' => TemplateResource::collection($this->whenLoaded('entertainments')),
                'food' => TemplateResource::collection($this->whenLoaded('food')),
                'gifts' => TemplateResource::collection($this->whenLoaded('gifts')),
                'housings' => TemplateResource::collection($this->whenLoaded('housings')),
                'incomes' => TemplateResource::collection($this->whenLoaded('incomes')),
                'investments' => TemplateResource::collection($this->whenLoaded('investments')),
                'loans' => TemplateResource::collection($this->whenLoaded('loans')),
                'medicals' => TemplateResource::collection($this->whenLoaded('medicals')),
                'miscellaneouses' => TemplateResource::collection($this->whenLoaded('miscellaneouses')),
                'personals' => TemplateResource::collection($this->whenLoaded('personals')),
                'shoppings' => TemplateResource::collection($this->whenLoaded('shoppings')),
                'subscriptions' => TemplateResource::collection($this->whenLoaded('subscriptions')),
                'taxes' => TemplateResource::collection($this->whenLoaded('taxes')),
                'travel' => TemplateResource::collection($this->whenLoaded('travel')),
                'utilities' => TemplateResource::collection($this->whenLoaded('utilities')),
                'vehicles' => TemplateResource::collection($this->whenLoaded('vehicles')),
            ],
        ];
    }
}
