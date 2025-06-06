<?php

namespace App\Integrations\Gorgias;

use App\Integrations\Base\AbstractWebhookHandler;
use App\Integrations\Gorgias\Requests\WebhookRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class GorgiasWebhookHandler extends AbstractWebhookHandler
{
    public static function shouldHandleForRequest(Request $request): bool
    {
        // todo : simple check, of course must be much more complex with signature validation, headers check, etc...
        return $request->get('from') === 'gorgias';
    }

    public static function getRequestClass(): FormRequest|string
    {
        return WebhookRequest::class;
    }

    public static function handle(): void
    {
        // todo : perform processes, database storage, etc...
        dump('Webhook handled by Gorgias integration');
    }
}
