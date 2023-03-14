<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\Chat;
use App\Models\Content;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class Kernel extends ConsoleKernel
{
    protected function scheduleTimezone()
    {
        return 'Europe/Moscow';
    }

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function () {
            // код, выполняемый каждый день в 09:30
            // обновляем updated_at для заголовка LastModified
            $pages = Content::all();
            try{
                DB::beginTransaction();
                foreach ($pages as $page) {
                    $time = time() - rand(60, 600); // разброс от 1 до 10 минут
                    // mysql сама формирует дату в поле timestamp
                    $page->updated_at = $time;
                    $page->save();
                }
                DB::commit();
                Cache::flush();
            }catch (Exception $e){
                DB::rollBack();
//                dd($e->getMessage());
            }

        })->dailyAt('09:30');

        /*$schedule->call(function () {
            // код, выполняемый раз в 5 минут
            $chat = new Chat();
            $chat->name = 'cron';
            $chat->msg = 'cron-test';
            $chat->save();
        })->everyFiveMinutes();*/
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
