<?php

namespace App\Http\Controllers;

use DateTime;
use Telegram\Bot\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\ChatDataController;

class MessageController extends Controller
{
    private $telegram = null;

    public function __construct() {
        $this->telegram = new Api(config('services.telegram.bot_token'));
    }

    public function handleWebhook(Request $request)
    {
        //Xử lý tin nhắn và trả lời lại nếu cần
        $update = $this->telegram->getWebhookUpdates();
        $message = $update->getMessage();
        $chatId = $message->getChat()->getId();
        $text = $message->getText();
        $text = $message->getText();
        $time = getdate(time());
        $date = $time['hours'] .":" .$time['minutes'] .":" .$time['seconds'] ."     " .$time['mday'] ."/" .$time['mon'] ."/" .$time['year'];
        // Xử lý tin nhắn và trả lời lại nếu cần
        $this->SendMessage($chatId, $message['message_id'], $text, $date);
    }

    public function SendMessage($chatId, $message_id_reply, $text, $date) {
        $message = new ChatDataController;
        $message_send = $message->ChatDataController($text) .$date;
        $this->telegram->sendMessage([
            'chat_id' => $chatId,
            'text' => $message_send,
            'reply_to_message_id' => $message_id_reply,
        ]);
    }
}