<?php

namespace App\Console\Commands;

use App\Models\Chat;
use Illuminate\Console\Command;

class Proba extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'proba';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Proba test';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        /*$username = $this->argument('user');
        $this->info('Hello ' . $username . '!');
        $age = $this->ask('What is your age? По русски пишет или...');
        $this->withProgressBar(1, function (){
            sleep(2);
        });
        $this->newLine();
        $this->info($age);*/
        $chat = new Chat();
        $chat->name = 'name';
        $chat->msg = 'bla';
        $chat->save();
        $this->info('Hello ');
    }
}
