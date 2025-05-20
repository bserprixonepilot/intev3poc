<?php

namespace App\Integrations\Base;

use App\Exceptions\MissingIntegrationConfigException;
use Illuminate\Support\ServiceProvider;

abstract class AbstractIntegrationServiceProvider extends ServiceProvider
{
    abstract protected static function getIntegrationName(): string;

    abstract protected function getConfigFilePath(): string;

    abstract public function getWebhookHandlerClass(): AbstractWebhookHandler | string;

    protected function loadConfig(): void
    {
        $this->mergeConfigFrom($this->getConfigFilePath(), 'integrations.' . $this->getIntegrationName());

        $this->validateConfig();
    }

    protected function validateConfig(): void
    {
        $mandatoryKeys = ['active'];

        foreach($mandatoryKeys as $key) {
            if (null === config('integrations.' . $this->getIntegrationName() . '.' . $key)) {
                throw new MissingIntegrationConfigException($this->getIntegrationName(), $key);
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
}
