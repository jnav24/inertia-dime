<?php

namespace App\Http\Requests;

use App\Rules\BooleanString;
use Illuminate\Foundation\Http\FormRequest;

class CommonExpenseRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|min:3',
            'amount' => 'required|decimal:2',
            'due_date' => 'int|max:31',
            'template' => new BooleanString(),
            'account_type' => 'uuid',
            'confirmation' => 'nullable|string|max:255',
            'paid_date' => 'nullable|date',
            'notes' => 'nullable|string',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
