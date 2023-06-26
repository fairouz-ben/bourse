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
       if( !(preg_match('/\w+(.)?\w+(@univ-alger.dz)/', $value)))
       {
        $fail(trans('validation.email_format'));
       // $fail('validation.email_format')->translate(); // new one
       }
        
    }
}
