<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Mailer\Messenger\SendEmailMessage;

class WeatherController extends Controller
{
    public static function get_weather() {
        $apiKey="";
        $cityName = "Ho Chi Minh City";
        $cityName = urlencode($cityName);
        $apiUrlWeather = "https://api.openweathermap.org/data/2.5/weather?&q={$cityName}&appid={$apiKey}&lang=vi";
        // Khởi tạo cURL
        $ch = curl_init();

        // Cấu hình cURL
        curl_setopt($ch, CURLOPT_URL, $apiUrlWeather);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Gửi yêu cầu và nhận phản hồi
        $response = curl_exec($ch);
        // Kiểm tra lỗi cURL
        if ($response === false) {
            $error = curl_error($ch);
            echo "cURL Error: $error";
            curl_close($ch);
            exit();
        }

        // Đóng cURL
        curl_close($ch);

        // Phân tích dữ liệu JSON
        $data = json_decode($response, true);
        if ($data['cod'] == 200) {
            $weatherDescription = $data['weather'][0]['description'];
            $weather = $data['weather'][0]['main'];
            $advice = "Lời nhắc: ";

            if ($weather == "Rain") {
                $weather .= "🌧️⛈️";
                $advice .= "Nhớ hãy đem áo mưa nhé!";
            } else if ($weather == "Clouds") {
                $advice .= "Dấu hiệu trời khá âm u!";
                $weather .= "☁️";
            }

            $info = [
                "Thời tiết hôm nay: $weather: $weatherDescription", 
                "Chúc bạn 1 ngày tốt lành!👍",
            ];

            $message = "";

            foreach ($info as $value) {
                $message .= $value ."\n";
            }

            if(isset($advice)) {
                $message .= $advice ."\n";
            }
            return $message;
        } else {
            return "Thời tiết không được cập nhật!";
        }
    }
}
