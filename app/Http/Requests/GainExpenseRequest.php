<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GainExpenseRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|min:2',
            'amount' => 'required|decimal:2',
            'pay_date' => 'date_format:Y-m-d',
            'template' => 'bool',
            'account_type' => 'uuid'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
