<?php

use Telegram\Bot\Api;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessageController;

Route::get('/', function(){
    return view('welcome');
});

Route::get('/set-webhook', function () {
    $telegram = new Api(config('services.telegram.bot_token'));
    $url = 'https://395e-2405-4802-813b-84b0-3969-ab8e-ec4c-a3b4.ngrok-free.app/VirtualAssistant/public/telegram/webhook';
    try {
        $response = $telegram->setWebhook(['url' => $url]);
        return 'Webhook set successfully: ' . $response;
    } catch (\Exception $e) {
        return 'Error: ' . $e->getMessage();
    }
});

Route::post('/telegram/webhook', [MessageController::class, 'handleWebhook'])->name('msg.post');