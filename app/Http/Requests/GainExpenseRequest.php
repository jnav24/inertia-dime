<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GainExpenseRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|min:3',
            'amount' => 'required|decimal:2',
            'initial_pay_date' => 'date',
            'template' => 'bool',
            'account_type' => 'uuid'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
