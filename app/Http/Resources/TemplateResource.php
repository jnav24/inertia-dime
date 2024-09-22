<?php

namespace App\Http\Resources;

use App\Models\BankTemplate;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin BankTemplate */
class TemplateResource extends JsonResource
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
