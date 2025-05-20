<?php

namespace App\Integrations\Base;

use Illuminate\Http\Request;

abstract class AbstractWebhookHandler
{
    abstract public static function shouldHandleForRequest(Request $request): bool;

    abstract public static function handle(Request $request): void;
}
