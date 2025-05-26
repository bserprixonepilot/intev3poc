<?php

namespace App\Integrations\Zendesk;

use App\Integrations\Base\AbstractWebhookHandler;
use Illuminate\Http\Request;

class ZendeskWebhookHandler extends AbstractWebhookHandler
{
    public static function shouldHandleForRequest(Request $request): bool
    {
        // todo : simple check, of course must be much more complex with signature validation, headers check, etc...
        return $request->get('from') === 'zendesk';
    }

    public static function handle(Request $request): void
    {
        dump('Webhook handled by Zendesk integration');
    }
}
