<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class TG
{
    // тупо текст
    public static function sendMessage($chat_id, $message)
    {
        Http::post('https://api.telegram.org/bot' . config('telegram.token') . '/sendMessage',
            [
                'chat_id' => $chat_id,
                'text' => $message
            ]
        );

    }

    // все что угодно
    public static function sendData($method, $data)
    {
        Http::post('https://api.telegram.org/bot' . config('telegram.token') . '/' . $method, $data);
    }

}
