<?php

namespace App\Http\Requests;

use App\Rules\BooleanString;
use Illuminate\Foundation\Http\FormRequest;

class CreditCardRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|min:3',
            'amount' => 'required|numeric|decimal:2',
            'due_date' => 'int|max:31',
            'template' => new BooleanString(),
            'account_type' => 'uuid',
            'apr' => 'nullable|numeric|decimal:2',
            'balance' => 'nullable|decimal:2',
            'exp_month' => 'nullable|numeric|max:12',
            'exp_year' => 'nullable|numeric|digits:4',
            'last_4' => 'nullable|numeric|digits:4',
            'limit' => 'nullable|numeric|decimal:2',
            'confirmation' => 'nullable|string|max:255',
            'paid_date' => 'nullable|date',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
