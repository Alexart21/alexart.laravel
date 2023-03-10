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
            $btns = [
                'inline_keyboard' => [
                    [
                        [
                            'text' => 'яблоки',
                            'callback_data' => 1
                        ],
                        [
                            'text' => 'груши',
                            'callback_data' => 2
                        ]
                    ],
                    [
                        [
                            'text' => 'лук',
                            'callback_data' => 3
                        ],
                        [
                            'text' => 'чеснок',
                            'callback_data' => 4
                        ]
                    ]
                ]
            ];
            $btns_text = '<b>Сделайте заказ :</b>';

            if(isset($this->data['callback_query'])){
                if($btnData == 1){
                    $selected = 'яблоки';
                    $icon = '🍏';
                    $btns['inline_keyboard'][0][0]['text'] = '✅' . 'яблоки';
                }elseif ($btnData == 2){
                    $selected = 'груши';
                    $icon = '🍐';
                    $btns['inline_keyboard'][0][1]['text'] = '✅' . 'груши';
                }elseif ($btnData == 3){
                    $selected = 'лук';
                    $icon = '🧅';
                    $btns['inline_keyboard'][1][0]['text'] = '✅' . 'лук';
                }elseif ($btnData == 4){
                    $selected = 'чеснок';
                    $icon = '🧄';
                    $btns['inline_keyboard'][1][1]['text'] = '✅' . 'чеснок';
                }else{
                    TG::sendMessage($chat_id, 'Что то пошло не так...');
                    die;
                }
                TG::editButtons($chat_id, $btns, $btns_text, $msg_id);
                TG::sendMessage($chat_id, 'Отличный выбор! Доставим Вам ' . $selected . '! ' . $icon);
                die;
            }
            TG::sendButtons($chat_id, $btns, $btns_text);
        } catch (Throwable $e) {
            // чтобы не отправлчть прибей ф-ию report() в app/Exceptions/Handler.php
            report($e);
            return false;
        }

    }

}
