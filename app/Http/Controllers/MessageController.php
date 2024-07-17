<?php

namespace App\Http\Controllers;

use DateTime;
use Telegram\Bot\Api;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class MessageController extends Controller
{
    public function handleWebhook(Request $request)
    {
        $telegram = new Api(config('services.telegram.bot_token'));
        
        //Xử lý tin nhắn và trả lời lại nếu cần
        $update = $telegram->getWebhookUpdates();
        $message = $update->getMessage();
        $chatId = $message->getChat()->getId();
        $text = $message->getText();
        $ngay = new DateTime();
        
        // Xử lý tin nhắn và trả lời lại nếu cần
        if ($text == '/weather') {
            $weather = WeatherController::get_weather();
            $message_send = "";
            foreach ($weather as $value) {
                $message_send .= $value ."\n";
            }

            $telegram->sendMessage([
                'chat_id' => $chatId,
                'text' => $message_send,
            ]);

        } else {
            $telegram->sendMessage([
                'chat_id' => $chatId,
                'text' => "Chào bạn của tôi bạn khỏe chứ!\nHình như bạn bị sai cú pháp cùng sửa nhé =))"
            ]);
        }
    }
}
