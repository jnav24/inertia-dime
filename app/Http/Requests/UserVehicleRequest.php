<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserVehicleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'color' => ['required'],
            'license' => ['nullable'],
            'make' => ['required'],
            'model' => ['required'],
            'year' => ['required', 'numeric', 'digits:4'],
        ];
    }
}
