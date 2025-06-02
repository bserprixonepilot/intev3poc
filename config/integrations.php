<?php

return [
    'global_config' => 'foo',

    /*
    |--------------------------------------------------------------------------
    | Integrations
    |--------------------------------------------------------------------------
    |
    | This file is for storing the configuration for all integrations.
    | Each integration has its own configuration section.
    |
    */

    'gorgias' => [
        'active' => env('GORGIAS_ACTIVE', false),
        'webhook_handler' => \App\Integrations\Gorgias\GorgiasWebhookHandler::class,
    ],

    'zendesk' => [
        'active' => env('ZENDESK_ACTIVE', false),
        'webhook_handler' => \App\Integrations\Zendesk\ZendeskWebhookHandler::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Providers
    |--------------------------------------------------------------------------
    |
    | This array is populated by the integration service providers.
    |
    */

    'providers' => [],
];
