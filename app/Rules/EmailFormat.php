<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class EmailFormat implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        
    }
    public function passes($attribute, $value)
    {
        // Define your specific email format here
        $pattern = '/\w+(.)?\w+(@univ-alger.dz)/ig';

        return preg_match($pattern, $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return (trans('validation.email_format'));//'The email must be in a specific format (e.g., user@univ-alger.dz).';
    }
}
