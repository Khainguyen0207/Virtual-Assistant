<?php

use Telegram\Bot\Api;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessageController;

Route::get('/', function(){
    return view('welcome');
});

Route::get('/set-webhook', function () {
    $telegram = new Api(config('services.telegram.bot_token'));
    $url = 'https://b927-14-161-13-253.ngrok-free.app/VirtualAssistant/public/telegram/webhook';
    try {
        $telegram = new Api(config('services.telegram.bot_token'));
        $time = getdate(time());

        if ($time['minutes'] == 13) {
            $telegram->sendMessage([
                'chat_id' => 5572600385,
                'text' => "Hello ",
            ]);
        }
        
        $response = $telegram->setWebhook(['url' => $url]);
        return 'Webhook set successfully: ' . $response;
    } catch (\Exception $e) {
        return 'Error: ' . $e->getMessage();
    }
});

Route::post('/telegram/webhook', [MessageController::class, 'handleWebhook'])->name('msg.post');