<?php

namespace App\Integrations\Gorgias;

use App\Integrations\Base\AbstractWebhookHandler;
use Illuminate\Http\Request;

class GorgiasWebhookHandler extends AbstractWebhookHandler
{
    public static function shouldHandleForRequest(Request $request): bool
    {
        // todo : simple check, of course must be much more complex with signature validation, headers check, etc...
        return $request->get('from') === 'gorgias';
    }

    public static function handle(Request $request): void
    {
        dump('Webhook handled by Gorgias integration');
    }
}
