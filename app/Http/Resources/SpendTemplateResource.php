<?php

namespace App\Http\Resources;

use App\Models\LoanTemplate;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin LoanTemplate */
class SpendTemplateResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->uuid,
            'data' => $this->data,
            'expense_type_id' => $this->expense_type_id,
        ];
    }
}
