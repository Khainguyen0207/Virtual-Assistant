<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function messageController()  {
        $botToken = "7432635283:AAFNt6p1dD-bqH4n8gNVZIfKzE6T42CM_-8";
        $webhookUrl = "http://virtualassistant.test/"; // Thay thế bằng URL của bạn

        $apiUrl = "https://api.telegram.org/bot{$botToken}/setWebhook?url={$webhookUrl}";
        $response = file_get_contents($apiUrl);
        echo $response;
    }
}
