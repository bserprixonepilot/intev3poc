<?php

namespace App\Services;

use App\Exceptions\WebhookCannotBeHandledException;
use App\Factories\WebhookHandlerFactory;
use App\Integrations\Contracts\WebhookHandlerInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class IntegrationResolver
{
    /**
     * The webhook handler factory instance.
     */
    protected WebhookHandlerFactory $webhookHandlerFactory;

    /**
     * Create a new integration resolver instance.
     */
    public function __construct(WebhookHandlerFactory $webhookHandlerFactory)
    {
        $this->webhookHandlerFactory = $webhookHandlerFactory;
    }

    /**
     * Find an integration that can handle the given request.
     */
    public function findIntegrationForRequest(Request $request): ?string
    {
        $integrations = Config::get('integrations');

        foreach ($integrations as $name => $config) {
            // Skip non-integration configs
            if (!is_array($config) || !isset($config['active']) || !isset($config['webhook_handler'])) {
                continue;
            }

            // Skip inactive integrations
            if (!$config['active']) {
                continue;
            }

            $handlerClass = $config['webhook_handler'];

            // Skip if the handler class doesn't exist or can't handle the request
            if (!class_exists($handlerClass) || !$handlerClass::shouldHandleForRequest($request)) {
                continue;
            }

            return $name;
        }

        return null;
    }

    /**
     * Resolve a webhook handler for the given request.
     */
    public function resolveWebhookHandler(Request $request): WebhookHandlerInterface
    {
        $integrationName = $this->findIntegrationForRequest($request);

        if (null === $integrationName) {
            throw new WebhookCannotBeHandledException("No integration found that can handle this request");
        }

        return $this->webhookHandlerFactory->create($integrationName);
    }
}
