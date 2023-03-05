<?php

namespace App\Listeners;

use App\Events\GetInPortfolioPage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Jobs\TelegramSender;

class PortfolioListener
{

    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\GetInPortfolioPage  $event
     * @return void
     */
    public function handle(GetInPortfolioPage $event)
    {
        TelegramSender::dispatch($event->ip);
    }
}
