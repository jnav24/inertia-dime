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
                'childcare' => TemplateResource::collection($this->whenLoaded('childcare')),
                'credit_cards' => TemplateResource::collection($this->whenLoaded('credit_cards')),
                'education' => TemplateResource::collection($this->whenLoaded('education')),
                'entertainment' => TemplateResource::collection($this->whenLoaded('entertainment')),
                'food' => TemplateResource::collection($this->whenLoaded('food')),
                'gift' => TemplateResource::collection($this->whenLoaded('gift')),
                'housing' => TemplateResource::collection($this->whenLoaded('housing')),
                'incomes' => TemplateResource::collection($this->whenLoaded('incomes')),
                'investments' => TemplateResource::collection($this->whenLoaded('investments')),
                'loan' => TemplateResource::collection($this->whenLoaded('loan')),
                'medical' => TemplateResource::collection($this->whenLoaded('medical')),
                'miscellaneous' => TemplateResource::collection($this->whenLoaded('miscellaneous')),
                'personal' => TemplateResource::collection($this->whenLoaded('personal')),
                'shopping' => TemplateResource::collection($this->whenLoaded('shopping')),
                'subscriptions' => TemplateResource::collection($this->whenLoaded('subscriptions')),
                'tax' => TemplateResource::collection($this->whenLoaded('tax')),
                'travel' => TemplateResource::collection($this->whenLoaded('travel')),
                'utilities' => TemplateResource::collection($this->whenLoaded('utilities')),
                'vehicles' => TemplateResource::collection($this->whenLoaded('vehicles')),
            ],
        ];
    }
}
