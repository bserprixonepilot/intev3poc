<?php

namespace App\Integrations\Zendesk\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CheckSignature implements ValidationRule
{
    /**
     * Indicates whether the rule should be implicit.
     *
     * @var bool
     */
    public $implicit = true;

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // todo : implement Zendesk signature check > https://developer.zendesk.com/documentation/webhooks/verifying/
        if (request()->get('signature') !== 'ok') {
            $fail('Invalid signature.');
        }
    }
}
