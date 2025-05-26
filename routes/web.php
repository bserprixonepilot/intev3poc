<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/integration/webhook', App\Http\Controllers\IntegrationWebhookController::class);
