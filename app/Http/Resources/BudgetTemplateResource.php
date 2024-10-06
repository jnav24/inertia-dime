<?php

namespace App\Http\Resources;

use App\Models\BudgetTemplate;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin BudgetTemplate */
class BudgetTemplateResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->uuid,
            'expenses' => [
                'banks' => TemplateResource::collection($this->whenLoaded('banks')),
                'childcares' => TemplateResource::collection($this->whenLoaded('childcares')),
                'creditCards' => TemplateResource::collection($this->whenLoaded('creditCards')),
                'education' => TemplateResource::collection($this->whenLoaded('education')),
                'entertainments' => TemplateResource::collection($this->whenLoaded('entertainments')),
                'food' => TemplateResource::collection($this->whenLoaded('food')),
                'gift' => TemplateResource::collection($this->whenLoaded('gifts')),
                'housing' => TemplateResource::collection($this->whenLoaded('housings')),
                'incomes' => TemplateResource::collection($this->whenLoaded('incomes')),
                'investments' => TemplateResource::collection($this->whenLoaded('investments')),
                'loan' => TemplateResource::collection($this->whenLoaded('loans')),
                'medical' => TemplateResource::collection($this->whenLoaded('medicals')),
                'miscellaneous' => TemplateResource::collection($this->whenLoaded('miscellaneous')),
                'personal' => TemplateResource::collection($this->whenLoaded('personals')),
                'shopping' => TemplateResource::collection($this->whenLoaded('shoppings')),
                'subscriptions' => TemplateResource::collection($this->whenLoaded('subscriptions')),
                'tax' => TemplateResource::collection($this->whenLoaded('taxes')),
                'travel' => TemplateResource::collection($this->whenLoaded('travel')),
                'utilities' => TemplateResource::collection($this->whenLoaded('utilities')),
                'vehicles' => TemplateResource::collection($this->whenLoaded('vehicles')),
            ],
        ];
    }
}
