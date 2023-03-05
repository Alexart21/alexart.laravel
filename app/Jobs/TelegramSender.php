<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class TelegramSender implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $ip;
    public function __construct($ip)
    {
        $this->ip = $ip;
    }

    public function handle()
    {
        //ID канала куда отправляем
        $idChannel = env('TG_ID');
        //токен бота которым отправляем сообщение
        $botToken = env('TG_TOKEN');
        //наше импровизированное сообщение
        $message = 'Зашли на страницу портфолио сайта ' . env('APP_URL') . ' с ip адреса ' . $this->ip;
        //кодируем его, чтобы сохранить переносы строк
        $message = urlencode($message);
        //после этого отправляем
        try {
            file_get_contents('https://api.telegram.org/bot' . $botToken . '/sendMessage?chat_id=' . $idChannel . '&text=' . $message);
        } catch (\Exception $e) {
            dd($e);
        }
    }
}
