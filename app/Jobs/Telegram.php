<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class Telegram implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $input_msg = mb_strtolower($this->data['message']['text']);
        $chat_id = $this->data['message']['chat']['id'];
        $msg_id = $this->data['message']['message_id'];

        $method = 'sendMessage';

        $send_data = [
            'chat_id' => $chat_id,
            'reply_to_message_id' => $msg_id,
        ];

        switch ($input_msg) {
            case 'да':
                $send_data = [
                    'chat_id' => $chat_id,
                    'reply_to_message_id' => $msg_id,
                    'text' => 'Что вы хотите заказать?',
                    'reply_markup' => [
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
                $send_data['text'] = 'Приходите еще';
                break;
            case 'яблоки':
                $send_data['text'] = 'заказ принят!';
                break;
            case 'груши':
                $send_data['text'] = 'заказ принят!';
                break;
            case 'лук':
                $send_data['text'] = 'заказ принят!';
                break;
            case 'чеснок':
                $send_data['text'] = 'заказ принят!';
                break;
            default:
                $send_data = [
                    'chat_id' => $chat_id,
                    'reply_to_message_id' => $msg_id,
                    'text' => 'Вы хотите сделать заказ?',
                    'reply_markup' => [
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
                CURLOPT_URL => 'https://api.telegram.org/bot' . config('telegram.token') . '/' . $method,
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
