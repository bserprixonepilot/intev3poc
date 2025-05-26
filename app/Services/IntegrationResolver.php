<?php

namespace App\Services;

use App\Exceptions\WebhookCannotBeHandledException;
use App\Integrations\Base\AbstractIntegrationServiceProvider;
use App\Integrations\Base\AbstractWebhookHandler;
use Illuminate\Http\Request;

class IntegrationResolver
{
    private function findMatchingProviderFor(callable $callback): ?AbstractIntegrationServiceProvider
    {
        return collect(config('integrations.providers'))->first($callback);
    }

    public function resolveWebhookHandler(Request $request): AbstractWebhookHandler
    {
        $provider = $this->findMatchingProviderFor(function(AbstractIntegrationServiceProvider $provider) use ($request) {
            return $provider->getWebhookHandlerClass()::shouldHandleForRequest($request);
        });

        if (null === $provider) {
            throw new WebhookCannotBeHandledException();
        }

        return new ($provider->getWebhookHandlerClass());
    }
}
