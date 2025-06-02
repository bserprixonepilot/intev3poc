<?php

namespace Tests\Unit\Services;

use App\Exceptions\WebhookCannotBeHandledException;
use App\Factories\WebhookHandlerFactory;
use App\Integrations\Contracts\WebhookHandlerInterface;
use App\Integrations\Gorgias\GorgiasWebhookHandler;
use App\Integrations\Zendesk\ZendeskWebhookHandler;
use App\Services\IntegrationResolver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class IntegrationResolverTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        // Set up test configuration
        Config::set('integrations.gorgias.active', true);
        Config::set('integrations.gorgias.webhook_handler', GorgiasWebhookHandler::class);
        Config::set('integrations.zendesk.active', true);
        Config::set('integrations.zendesk.webhook_handler', ZendeskWebhookHandler::class);
    }

    /** @test */
    public function it_resolves_gorgias_webhook_handler_for_gorgias_request()
    {
        // Arrange
        $request = new Request(['from' => 'gorgias']);
        $factory = $this->createMock(WebhookHandlerFactory::class);
        $factory->expects($this->once())
            ->method('create')
            ->with('gorgias')
            ->willReturn(new GorgiasWebhookHandler());

        $resolver = new IntegrationResolver($factory);

        // Act
        $handler = $resolver->resolveWebhookHandler($request);

        // Assert
        $this->assertInstanceOf(GorgiasWebhookHandler::class, $handler);
    }

    /** @test */
    public function it_resolves_zendesk_webhook_handler_for_zendesk_request()
    {
        // Arrange
        $request = new Request(['from' => 'zendesk']);
        $factory = $this->createMock(WebhookHandlerFactory::class);
        $factory->expects($this->once())
            ->method('create')
            ->with('zendesk')
            ->willReturn(new ZendeskWebhookHandler());

        $resolver = new IntegrationResolver($factory);

        // Act
        $handler = $resolver->resolveWebhookHandler($request);

        // Assert
        $this->assertInstanceOf(ZendeskWebhookHandler::class, $handler);
    }

    /** @test */
    public function it_throws_exception_when_no_integration_can_handle_request()
    {
        // Arrange
        $request = new Request(['from' => 'unknown']);
        $factory = $this->createMock(WebhookHandlerFactory::class);
        $resolver = new IntegrationResolver($factory);

        // Act & Assert
        $this->expectException(WebhookCannotBeHandledException::class);
        $resolver->resolveWebhookHandler($request);
    }
}
