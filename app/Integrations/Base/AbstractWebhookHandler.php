<?php

namespace App\Integrations\Base;

use App\Integrations\Contracts\WebhookHandlerInterface;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

abstract class AbstractWebhookHandler implements WebhookHandlerInterface
{
    protected FormRequest $request;

    abstract public static function shouldHandleForRequest(Request $request): bool;

    /**
     * Get the FormRequest class to use for validation.
     */
    abstract protected static function getRequestClass(): string;

    public function performChecks(): void
    {
        // Laravel auto trigger validation rules when calling app(MyRequest::class)
        $this->request = app(static::getRequestClass());
    }

    /**
     * Handle the webhook.
     */
    abstract public function handle(): void;
}
