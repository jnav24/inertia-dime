<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class BooleanString implements Rule
{
    public function passes($attribute, $value)
    {
        return in_array(strtolower($value), ['true', 'false', '1', '0']);
    }

    public function message()
    {
        return 'The :attribute must be a boolean string.';
    }
}
