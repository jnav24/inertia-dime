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
        ];
    }
}
