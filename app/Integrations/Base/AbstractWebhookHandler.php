<?php

namespace App\Integrations\Base;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

abstract class AbstractWebhookHandler
{
    protected FormRequest $request;

    abstract public static function shouldHandleForRequest(Request $request): bool;

    abstract public static function getRequestClass(): FormRequest|string;

    public function performChecks(): void
    {
        // Laravel auto trigger validation rules when calling app(MyRequest::class)
        $this->request = app(static::getRequestClass());
    }

    abstract public static function handle(): void;
}
