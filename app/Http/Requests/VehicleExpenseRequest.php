<?php

namespace App\Http\Requests;

use App\Rules\BooleanString;
use Illuminate\Foundation\Http\FormRequest;

class VehicleExpenseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'account_type' => 'required|uuid',
            'amount' => 'required|numeric|decimal:2',
            'balance' => 'nullable|decimal:2',
            'confirmation' => 'nullable|string|max:255',
            'due_date' => 'int|max:31',
            'template' => new BooleanString(),
            'vehicle' => 'required|uuid',
            'paid_date' => 'nullable|date',
            'mileage' => 'nullable|string',
            'notes' => 'nullable|string',
        ];
    }
}
