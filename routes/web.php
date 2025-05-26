<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/integration/webhook', App\Http\Controllers\IntegrationWebhookController::class);
