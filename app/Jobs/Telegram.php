<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Helpers\TG;
use Illuminate\Support\Facades\Log;

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
        // все обернуто в try catch
        try{
            if(isset($this->data['message'])){
                $input_msg = isset($this->data['message']['text']) ? mb_strtolower($this->data['message']['text']) : '';
                $chat_id = $this->data['message']['chat']['id'];
                $msg_id = $this->data['message']['message_id'];

            }elseif($this->data['callback_query']){ // нажали кнопку inline_keyboard
                $btnData = mb_strtolower($this->data['callback_query']['data']);
                $chat_id = $this->data['callback_query']['message']['chat']['id'];
                $msg_id = $this->data['callback_query']['message']['message_id'];
            }
            // отправка файлов
            // путь к файлу от папки public
//            TG::sendFile($chat_id, 'img/msg.png', 'my_photo');
//            TG::sendMessage($chat_id, 'bla');
            $buttons = [
                'inline_keyboard' => [
                    [
                        [
                            'text' => 'btn1',
                            'callback_data' => 1
                        ],
                        [
                            'text' => 'btn2',
                            'callback_data' => 2
                        ]
                    ]
                ]
            ];

            if(isset($this->data['callback_query'])){
//                TG::sendMessage($chat_id, $btnData);
                if($btnData == 1){
//                    TG::sendMessage($chat_id, '1');
                    $reply_markup = [
                        'inline_keyboard' => [
                            [
                                [
                                    'text' => '✅btn1',
                                    'callback_data' => 1
                                ],
                                [
                                    'text' => 'btn2',
                                    'callback_data' => 2
                                ]
                            ]
                        ]
                    ];
                }elseif ($btnData == 2){
//                    TG::sendMessage($chat_id, '2');
                    $reply_markup = [
                        'inline_keyboard' => [
                            [
                                [
                                    'text' => 'btn1',
                                    'callback_data' => 1
                                ],
                                [
                                    'text' => '✅btn2',
                                    'callback_data' => 2
                                ]
                            ]
                        ]
                    ];
                }
                TG::editButtons($chat_id, $reply_markup, 'жми что нибудь', $msg_id);
                die;
            }
            TG::sendButtons($chat_id, $buttons, 'жми что нибудь');
            die;
            switch ($input_msg) {
                case 'да':
                    $send_data = [
                        'chat_id' => $chat_id,
//                    'reply_to_message_id' => $msg_id,
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
                    TG::sendData('sendMessage', $send_data);
                    break;
                case 'нет':
                    TG::sendMessage($chat_id, 'Приходите еще!');
                    break;
                case 'яблоки':
                    TG::sendMessage($chat_id, "Заказ принят! Будут Вам <b>$input_msg</b>");
                    break;
                case 'груши':
                    TG::sendMessage($chat_id, "Заказ принят! Будут Вам <b>$input_msg</b>");
                    break;
                case 'лук':
                    TG::sendMessage($chat_id, "Заказ принят! Будет Вам <b>$input_msg</b>");
                    break;
                case 'чеснок':
                    TG::sendMessage($chat_id, "Заказ принят! Будет Вам <b>$input_msg</b>");
                    break;
                default:
                    $send_data = [
                        'chat_id' => $chat_id,
//                    'reply_to_message_id' => $msg_id,
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
                    TG::sendData('sendMessage', $send_data);
            }

        } catch (Throwable $e) {
            report($e);
            return false;
        }

    }

}
