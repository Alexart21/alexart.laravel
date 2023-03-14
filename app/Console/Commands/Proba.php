<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Proba extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'proba {user : The ID of the user}';

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
        $username = $this->argument('user');
        $this->info('Hello ' . $username . '!');
        $age = $this->ask('What is your age? По русски пишет или...');

       /* $this->withProgressBar(function () {
            sleep(3);
        });*/
        $this->withProgressBar(1, function (){
            sleep(2);
        });
        $this->newLine();
        $this->info($age);
    }
}
