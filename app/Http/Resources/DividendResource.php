<?php

namespace App\Http\Resources;

use App\Models\Dividend;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Dividend */
class DividendResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'change' => $this->change,
            'change_percentage' => $this->change_percentage,
            'declaration_date' => $this->declaration_date,
            'description' => $this->description,
            'ex_date' => $this->ex_date,
            'frequency' => $this->frequency,
            'image' => $this->image,
            'name' => $this->company_name,
            'payout_amount' => $this->payout_amount,
            'payout_date' => $this->payout_date,
            'price' => $this->price,
            'record_date' => $this->record_date,
            'sector' => $this->sector,
            'symbol' => $this->symbol,
            'uuid' => $this->uuid,
            'yield' => $this->yield,
        ];
    }
}
