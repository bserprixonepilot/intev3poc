<?php

namespace App\Integrations\Base;

use App\Exceptions\MissingIntegrationConfigException;
use App\Integrations\Contracts\IntegrationServiceProviderInterface;
use App\Integrations\Contracts\WebhookHandlerInterface;
use Illuminate\Support\ServiceProvider;

abstract class AbstractIntegrationServiceProvider extends ServiceProvider implements IntegrationServiceProviderInterface
{
    /**
     * Get the name of the integration.
     */
    abstract public static function getIntegrationName(): string;

    /**
     * Get the path to the configuration file.
     */
    abstract protected function getConfigFilePath(): string;

    /**
     * Get the webhook handler class for this integration.
     */
    abstract public function getWebhookHandlerClass(): string;

    /**
     * Load the configuration file.
     */
    protected function loadConfig(): void
    {
        $this->mergeConfigFrom($this->getConfigFilePath(), 'integrations.' . static::getIntegrationName());

        $this->validateConfig();
    }

    /**
     * Validate the configuration.
     */
    protected function validateConfig(): void
    {
        $mandatoryKeys = ['active'];

        foreach($mandatoryKeys as $key) {
            if (null === config('integrations.' . static::getIntegrationName() . '.' . $key)) {
                throw new MissingIntegrationConfigException(static::getIntegrationName(), $key);
            }
        }

        // Add Integration provider to the array
        config(['integrations.providers' => array_merge(config('integrations.providers', []), [$this])]);
    }

    /**
     * Register services.
     */
    public function register(): void
    {
        $this->loadConfig();
    }

    /**
     * Check if the integration is active.
     */
    public function isActive(): bool
    {
        return !! config('integrations.' . static::getIntegrationName() . '.active');
    }
}
