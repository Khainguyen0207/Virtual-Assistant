<?php

namespace App\Http\Controllers;

use DateTime;
use Telegram\Bot\Api;
use Illuminate\Http\Request;

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
        $message_send = null;
        if ($text == '/weather') {
            $weather = WeatherController::get_weather();
            foreach ($weather as $value) {
                $message_send .= $value ."\n";
            }
            $message_send .= $date;
        }
        $this->SendMessage($chatId, $message_send, $message['message_id']);
    }

    public function SendMessage($chatId, $message_send, $message_id_reply) {
        if (empty($message_send)) {
            $message_send = "Chào bạn nhó! Tớ hơi yếu nên là chưa hiểu bạn nói gì!😓🤖";
        }

        $this->telegram->sendMessage([
            'chat_id' => $chatId,
            'text' => $message_send,
            'reply_to_message_id' => $message_id_reply,
        ]);
    }
}