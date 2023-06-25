<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\Rule;


class FindOutNumberRule implements Rule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */


     
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        
    }

    // vai nicher 2ta otirikto nisi
    public function passes($attribute, $value)
    {
        if (preg_match('~[0-9]~', $value)) {
            return false;
        }
        else {
            return true;
        }
    }
    public function message()
    {
        return 'your input can not contzins any number from 0-9';
    }
}
