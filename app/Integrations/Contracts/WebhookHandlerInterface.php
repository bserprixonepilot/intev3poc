<?php

namespace App\Integrations\Contracts;

use Illuminate\Http\Request;

interface WebhookHandlerInterface
{
    /**
     * Determine if this handler can handle the given request.
     */
    public static function shouldHandleForRequest(Request $request): bool;

    /**
     * Perform validation and other checks before handling the webhook.
     */
    public function performChecks(): void;

    /**
     * Handle the webhook.
     */
    public function handle(): void;
}
