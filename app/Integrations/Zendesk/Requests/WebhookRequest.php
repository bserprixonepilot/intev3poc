<?php

namespace App\Integrations\Zendesk\Requests;

use App\Integrations\Zendesk\Rules\CheckSignature;
use Illuminate\Foundation\Http\FormRequest;

class WebhookRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            new CheckSignature,
//            'ticket_id' => ['required'],
//            // todo : add other validation rules
        ];
    }
}
