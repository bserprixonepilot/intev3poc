<?php

namespace App\Integrations\Zendesk;

use App\Integrations\Base\AbstractIntegrationServiceProvider;
use App\Integrations\Base\AbstractWebhookHandler;

class ZendeskIntegrationServiceProvider extends AbstractIntegrationServiceProvider
{
    public const INTEGRATION_NAME = 'zendesk';

    protected static function getIntegrationName(): string
    {
        return self::INTEGRATION_NAME;
    }

    protected function getConfigFilePath(): string
    {
        return dirname(__FILE__) . '/Config/zendesk.php';
    }

    public function getWebhookHandlerClass(): AbstractWebhookHandler | string
    {
        return ZendeskWebhookHandler::class;
    }
}
