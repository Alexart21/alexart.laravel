<?php

namespace App\Listeners;

use App\Events\GetInPortfolioPage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

// с интерфейсом ShouldQueue автоматом добавляется в очередь
class PortfolioListener implements ShouldQueue
{



    public function __construct()
    {
    }

    public function handle(GetInPortfolioPage $event)
    {
        //ID канала куда отправляем
        $id = config('telegram.id');
        //токен бота которым отправляем сообщение
        $token = config('telegram.token');
        //наше импровизированное сообщение
        $message = 'Зашли на страницу портфолио сайта ' . config('app.url') . ' с ip адреса ' . $event->ip;
        //кодируем его, чтобы сохранить переносы строк
        $message = urlencode($message);
        //после этого отправляем
        try {
            file_get_contents('https://api.telegram.org/bot' . $token . '/sendMessage?chat_id=' . $id . '&text=' . $message);
        } catch (\Exception $e) {
//            dd($e);
        }
    }
}
