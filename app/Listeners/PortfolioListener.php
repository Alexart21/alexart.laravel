<?php

namespace App\Listeners;

use App\Events\GetInPortfolioPage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Throwable;
use Stevebauman\Location\Facades\Location;
use App\Helpers\TG;

// с интерфейсом ShouldQueue автоматом добавляется в очередь
class PortfolioListener implements ShouldQueue
{


    public function __construct()
    {
    }

    public function handle(GetInPortfolioPage $event)
    {
        $chat_id = config('telegram.id');

        $loc = Location::get($event->ip);

        $message = 'Зашли на страницу портфолио сайта ' . config('app.url') . ' с ip адреса ' . $event->ip . ' Предположительная локация '
            . '<b>' . $loc->countryName . ' - ' . $loc->regionName . ' - ' .$loc->cityName . '</b>';
        try {
            TG::sendMessage($chat_id, $message);
        } catch (\Exception $e) {
//            dd($e);
        }
    }
}
