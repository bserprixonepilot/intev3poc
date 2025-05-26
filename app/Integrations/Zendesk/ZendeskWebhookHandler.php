<?php

namespace App\Integrations\Zendesk;

use App\Integrations\Base\AbstractWebhookHandler;
use App\Integrations\Zendesk\Requests\WebhookRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ZendeskWebhookHandler extends AbstractWebhookHandler
{
    public static function shouldHandleForRequest(Request $request): bool
    {
        // todo : simple check, of course must be much more complex with signature validation, headers check, etc...
        return $request->get('from') === 'zendesk';
    }

    public static function getRequestClass(): FormRequest|string
    {
        return WebhookRequest::class;
    }

    public static function handle(): void
    {
        // todo : perform processes, database storage, etc...
        dump('Webhook handled by Zendesk integration');
    }
}
