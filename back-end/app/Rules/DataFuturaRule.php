<?php

namespace App\Rules;

use DateTime;
use Illuminate\Contracts\Validation\Rule;

class DataFuturaRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $today = date('Y-m-d');

        return strtotime($today) == strtotime($value) || strtotime($value) > strtotime($today);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Data deve ser futura.';
    }
}
