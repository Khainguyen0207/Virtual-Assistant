<?php

use App\Http\Controllers\Auto\EveryDay;
use Telegram\Bot\Api;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessageController;

Route::get('/set-webhook', function () {
    $url = env('DOMAIN_SETWEBHOOK');
    try {
        $telegram = new Api(config('services.telegram.bot_token'));
        $response = $telegram->setWebhook(['url' => $url]);
        return 'Webhook set successfully: ' . $response;
    } catch (\Exception $e) {
        return 'Error: ' . $e->getMessage();
    }
});

Route::post('/telegram/webhook', [MessageController::class, 'handleWebhook'])->name('msg.post');