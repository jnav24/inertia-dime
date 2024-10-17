<?php

namespace App\Http\Resources;

use App\Models\UserVehicle;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin UserVehicle */
class UserVehicleResource extends JsonResource
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
            'color' => $this->data->color,
            'make' => $this->data->make,
            'model' => $this->data->model,
            'year' => $this->data->year,
            'license' => $this->data->license,
            'is_active' => empty($this->deleted_at),
        ];
    }
}
