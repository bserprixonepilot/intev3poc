<?php

return [
    App\Providers\AppServiceProvider::class,

    // List above integration providers
    App\Integrations\Zendesk\ZendeskIntegrationServiceProvider::class,
    App\Integrations\Gorgias\GorgiasIntegrationServiceProvider::class,
];
