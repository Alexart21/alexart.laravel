<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;

class BotController extends Controller
{


    private static $TOKEN;

    public function index(Request $request)
    {

        self::$TOKEN = env('TG_TOKEN');

        $data = $request->all();

        $input_msg = mb_strtolower($data['message']['text']);
        $chat_id = $data['message']['chat']['id'];
        $msg_id = $data['message']['message_id'];

        $method = 'sendMessage';

        $send_data = [
            'chat_id' => $chat_id,
            'reply_to_message_id' => $msg_id,
        ];


        switch ($input_msg) {
            case 'да':
                $method = 'sendMessage';
                $send_data = [
                    'chat_id' => $chat_id,
                    'reply_to_message_id' => $msg_id,
                    'text' => 'Что вы хотите заказать?',
                    'reply_markup'  => [
                        'resize_keyboard' => true,
                        'keyboard' => [
                            [
                                ['text' => 'Яблоки'],
                                ['text' => 'Груши'],
                            ],
                            [
                                ['text' => 'Лук'],
                                ['text' => 'Чеснок'],
                            ]
                        ]
                    ]
                ];
                break;
            case 'нет':
                $method = 'sendMessage';
                $send_data['text'] = 'Приходите еще';
                break;
            case 'яблоки':
                $method = 'sendMessage';
                $send_data['text'] = 'заказ принят!';
                break;
            case 'груши':
                $method = 'sendMessage';
                $send_data['text'] = 'заказ принят!';
                break;
            case 'лук':
                $method = 'sendMessage';
                $send_data['text'] = 'заказ принят!';
                break;
            case 'чеснок':
                $method = 'sendMessage';
                $send_data['text'] = 'заказ принят!';
                break;
            default:
                $method = 'sendMessage';
                $send_data = [
                    'chat_id' => $chat_id,
                    'reply_to_message_id' => $msg_id,
                    'text' => 'Вы хотите сделать заказ?',
                    'reply_markup'  => [
                        'resize_keyboard' => true,
                        'keyboard' => [
                            [
                                ['text' => 'Да'],
                                ['text' => 'Нет'],
                            ]
                        ]
                    ]
                ];
        }

        self::send($method, $send_data);

    }

    private static function send($method, $data, $headers = [])
    {

        try {
            $curl = curl_init();
            curl_setopt_array($curl, [
                CURLOPT_POST => 1,
                CURLOPT_HEADER => 0,
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => 'https://api.telegram.org/bot' . self::$TOKEN . '/' . $method,
                CURLOPT_POSTFIELDS => json_encode($data),
                CURLOPT_HTTPHEADER => array_merge(array("Content-Type: application/json"))
            ]);
            curl_exec($curl);
            curl_close($curl);
        } catch (\Exception $e) {
//            dd($e);
        }

    }
}
