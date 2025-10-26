<?php

namespace App\Http\Requests;

use App\Rules\BooleanString;
use Illuminate\Foundation\Http\FormRequest;

class GainExpenseRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required',
            'amount' => 'required|decimal:2',
            'pay_date' => 'date_format:Y-m-d',
            'template' => new BooleanString(),
            'account_type' => 'uuid'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
