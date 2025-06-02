<?php

namespace App\Factories;

use App\Exceptions\WebhookCannotBeHandledException;
use App\Integrations\Contracts\WebhookHandlerInterface;
use Illuminate\Support\Facades\Config;

class WebhookHandlerFactory
{
    /**
     * Create a webhook handler for the given integration name.
     *
     * @param string $integrationName
     * @return WebhookHandlerInterface
     * @throws WebhookCannotBeHandledException
     */
    public function create(string $integrationName): WebhookHandlerInterface
    {
        $handlerClass = Config::get("integrations.{$integrationName}.webhook_handler");

        if (!$handlerClass || !class_exists($handlerClass)) {
            throw new WebhookCannotBeHandledException("No webhook handler found for integration: {$integrationName}");
        }

        return new $handlerClass();
    }
}
