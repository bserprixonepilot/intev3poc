<?php

namespace App\Integrations\Contracts;

interface IntegrationServiceProviderInterface
{
    /**
     * Get the name of the integration.
     */
    public static function getIntegrationName(): string;

    /**
     * Get the webhook handler class for this integration.
     */
    public function getWebhookHandlerClass(): string;

    /**
     * Check if the integration is active.
     */
    public function isActive(): bool;
}
