<?php

namespace App\Rules;

use App\Models\Member;
use Illuminate\Contracts\Validation\InvokableRule;

class MemberUniqueMobile implements InvokableRule
{
    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     * @return void
     */
    public function __invoke($attribute, $value, $fail)
    {
        if (Member::where('mobile', "966{$value}")->exists()) $fail(__("This mobile number is already registered"));
    }
}
