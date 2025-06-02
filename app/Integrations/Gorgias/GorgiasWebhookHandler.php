<?php

namespace App\Integrations\Gorgias;

use App\Integrations\Base\AbstractWebhookHandler;
use App\Integrations\Gorgias\Requests\WebhookRequest;
use Illuminate\Http\Request;

class GorgiasWebhookHandler extends AbstractWebhookHandler
{
    public static function shouldHandleForRequest(Request $request): bool
    {
        // todo : simple check, of course must be much more complex with signature validation, headers check, etc...
        return $request->get('from') === 'gorgias';
    }

    protected static function getRequestClass(): string
    {
        return WebhookRequest::class;
    }

    public function handle(): void
    {
        // todo : perform processes, database storage, etc...
        dump('Webhook handled by Gorgias integration');
    }
}
