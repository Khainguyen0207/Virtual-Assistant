<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SendMessageController extends Controller
{
    public static function send($method, $data) {
        $method = "getUpdates";
        $api_bot = "7432635283:AAFNt6p1dD-bqH4n8gNVZIfKzE6T42CM_-8";
        $url_socialNetWorld = "https://api.telegram.org/bot{$api_bot}/{$method}";
        $id = 5572600385;
        $text = "";

        foreach ($data as $value) {
            $text .= $value ."\n";
        }
        
        
        //Create
        $ch = curl_init();
    
        //Config
    
        curl_setopt($ch, CURLOPT_URL, $url_socialNetWorld);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        $result = json_decode($response,true);

        if ($result['ok']) {
            $message_id = sizeof($result['result']) - 1;
            $message_id_text = $result['result'][$message_id]['message']['message_id'];
            $message_id_content = $result['result'][$message_id]['message']['text'];
            echo ("<pre> ");
            print_r($result['result'][$message_id]['message']);
            echo ("</pre>");
            //ID cập nhật tin nhắn mới nhất
        } else {
            $id = 0;
        }
        curl_close($ch);
        
        $data = [
            'chat_id' => $id,
            'text' => $text,
            'reply_message_to_id' => $message_id_text
        ];
        echo "ID Send: $message_id_text";

        $url_socialNetWorld = "https://api.telegram.org/bot{$api_bot}/sendMessage";
        //Create
        $ch = curl_init();
            
        //Config

        curl_setopt($ch, CURLOPT_URL, $url_socialNetWorld);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        $response_send = curl_exec($ch);
        $result_send = json_decode($response_send,true);
        if ($result_send['ok']) {
            if (strtolower($message_id_content) == "update") {
                echo ("<pre> ");
                print_r($result_send);
                echo ("</pre>");
            }
        } else {
            echo "Error";
        }

        
        curl_close($ch);
    }
}
