<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChatDataController extends Controller
{
    public function ChatDataController($text) {
        switch ($text) {
            case '/start': return "Chào bạn nhá! Mình là trợ lý ảo. Mình sẽ cập nhật thông tin hằng ngày cho bạn!\n";

            case '/weather': return WeatherController::get_weather();     

            default: fwrite(fopen('Message_Data.txt', 'a'), "\n$text" ); return "Chào bạn nhó!\nTớ hơi yếu nên là chưa hiểu bạn nói gì!😓🤖\n";
        
        }
    } 
}