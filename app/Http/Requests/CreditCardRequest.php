<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreditCardRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|min:3',
            'amount' => 'required|numeric|decimal:2',
            'due_date' => 'int|max:31',
            'template' => 'bool',
            'account_type' => 'uuid',
            'apr' => 'nullable|numeric|decimal:2',
            'balance' => 'nullable|decimal:2',
            'exp_month' => 'nullable|int|digits:2',
            'exp_year' => 'nullable|int|digits:4',
            'last_4' => 'nullable|int|digits:4',
            'limit' => 'nullable|numeric|decimal:2',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
