<?php

namespace App\Integrations\Zendesk;

use App\Integrations\Base\AbstractIntegrationServiceProvider;

class ZendeskIntegrationServiceProvider extends AbstractIntegrationServiceProvider
{
    public const INTEGRATION_NAME = 'zendesk';

    public static function getIntegrationName(): string
    {
        return self::INTEGRATION_NAME;
    }

    protected function getConfigFilePath(): string
    {
        return dirname(__FILE__) . '/Config/zendesk.php';
    }

    public function getWebhookHandlerClass(): string
    {
        return ZendeskWebhookHandler::class;
    }
}
