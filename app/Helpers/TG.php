<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class TG
{
    const url = 'https://api.telegram.org/bot';

    // тупо текст
    public static function sendMessage($chat_id, $message)
    {
        Http::post(self::url . config('telegram.token') . '/sendMessage',
            [
                'chat_id' => $chat_id,
                'text' => $message,
                'parse_mode' => 'html'
            ]
        );

    }

    // все что угодно любой допустимый метод и данные
    public static function sendData($method, $data)
    {
        Http::post(self::url . config('telegram.token') . '/' . $method, $data);
    }

    public static function sendFile($chat_id, $file, $caption = '')
    {
        Http::attach('document', file_get_contents(public_path($file)), basename($file))->post(self::url . config('telegram.token') . '/sendDocument',
            [
                'chat_id' => $chat_id,
                'caption' => $caption,
            ]
        );
    }

    // это тоже работает
    /*public static function sendDocument($chat_id, $file, $caption = '')
    {
        $token = config('telegram.token');
        $arrayQuery = array(
            'chat_id' => $chat_id,
            'caption' => $caption,
            'document' => curl_file_create(Storage::get('public/') . $file, 'image/png' , $file)
        );
        $ch = curl_init('https://api.telegram.org/bot'. $token .'/sendDocument');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $arrayQuery);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_exec($ch);
        curl_close($ch);
    }*/

}
