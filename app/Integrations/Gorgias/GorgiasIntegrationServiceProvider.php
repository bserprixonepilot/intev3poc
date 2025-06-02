<?php

namespace App\Integrations\Gorgias;

use App\Integrations\Base\AbstractIntegrationServiceProvider;

class GorgiasIntegrationServiceProvider extends AbstractIntegrationServiceProvider
{
    public const INTEGRATION_NAME = 'gorgias';

    public static function getIntegrationName(): string
    {
        return self::INTEGRATION_NAME;
    }

    protected function getConfigFilePath(): string
    {
        return dirname(__FILE__) . '/Config/gorgias.php';
    }

    public function getWebhookHandlerClass(): string
    {
        return GorgiasWebhookHandler::class;
    }
}
