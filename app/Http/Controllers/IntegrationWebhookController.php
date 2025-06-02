<?php

namespace App\Http\Controllers;

use App\Services\IntegrationResolver;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class IntegrationWebhookController extends Controller
{
    /**
     * The integration resolver instance.
     */
    protected IntegrationResolver $integrationResolver;

    /**
     * Create a new controller instance.
     */
    public function __construct(IntegrationResolver $integrationResolver)
    {
        $this->integrationResolver = $integrationResolver;
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        //todo : do not return Response from the webhook handler since it will be done in ASYNC in fine
        $webhookHandler = $this->integrationResolver->resolveWebhookHandler($request);

        $webhookHandler->performChecks();
        $webhookHandler->handle();

        // todo : instead of handling the webhook directly, may be store it raw and dispatch afterwards ?
        // todo : or at least handle a few checks to see if the webhook should be stored and handled later

        return response('OK', Response::HTTP_OK);
    }
}
