<?php

namespace App\Integrations\Gorgias;

use App\Integrations\Base\AbstractIntegrationServiceProvider;
use App\Integrations\Base\AbstractWebhookHandler;

class GorgiasIntegrationServiceProvider extends AbstractIntegrationServiceProvider
{
    public const INTEGRATION_NAME = 'gorgias';

    protected static function getIntegrationName(): string
    {
        return self::INTEGRATION_NAME;
    }

    protected function getConfigFilePath(): string
    {
        return dirname(__FILE__) . '/Config/gorgias.php';
    }

    public function getWebhookHandlerClass(): AbstractWebhookHandler|string
    {
        return GorgiasWebhookHandler::class;
    }
}
